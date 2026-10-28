<?php

namespace App\Livewire\Dashboard;

use App\Enums\ApplicationDeploymentStatus;
use App\Models\Application;
use App\Models\ApplicationDeploymentQueue;
use App\Models\Project;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * The dashboard's headline numbers: deployments and their success rate over
 * the last week, resource and server health, and two weeks of deployments by
 * outcome. Reads stored state of the current team only.
 */
class Overview extends Component
{
    public const CHART_DAYS = 14;

    /**
     * Deployments of the current team per day, oldest first.
     *
     * @return Collection<int, array{date: string, label: string, finished: int, failed: int, other: int, total: int}>
     */
    #[Computed]
    public function deploymentDays(): Collection
    {
        $since = now()->startOfDay()->subDays(self::CHART_DAYS - 1);

        $deployments = ApplicationDeploymentQueue::query()
            ->ownedByTeam(currentTeam()->id)
            ->where('created_at', '>=', $since)
            ->get(['status', 'created_at'])
            ->groupBy(fn (ApplicationDeploymentQueue $deployment) => $deployment->created_at->toDateString());

        return collect(range(0, self::CHART_DAYS - 1))->map(function (int $offset) use ($since, $deployments) {
            $day = $since->copy()->addDays($offset);
            $statuses = $deployments->get($day->toDateString(), collect())->pluck('status');
            $finished = $statuses->filter(fn ($status) => $status === ApplicationDeploymentStatus::FINISHED->value)->count();
            $failed = $statuses->filter(fn ($status) => $status === ApplicationDeploymentStatus::FAILED->value)->count();

            return [
                'date' => $day->toDateString(),
                'label' => $day->format('M j'),
                'finished' => $finished,
                'failed' => $failed,
                'other' => $statuses->count() - $finished - $failed,
                'total' => $statuses->count(),
            ];
        });
    }

    /**
     * @return array{count: int, previous: int, rate: ?int, previous_rate: ?int, spark: array<int, int>}
     */
    #[Computed]
    public function deploymentStats(): array
    {
        $thisWeek = $this->deploymentDays->slice(-7);
        $lastWeek = $this->deploymentDays->slice(0, self::CHART_DAYS - 7);

        return [
            'count' => $thisWeek->sum('total'),
            'previous' => $lastWeek->sum('total'),
            'rate' => $this->successRate($thisWeek),
            'previous_rate' => $this->successRate($lastWeek),
            'spark' => $this->deploymentDays->pluck('total')->all(),
        ];
    }

    /**
     * Applications, services and databases of the current team by stored state.
     *
     * @return array{running: int, busy: int, stopped: int, total: int}
     */
    #[Computed]
    public function resourceHealth(): array
    {
        $statuses = Application::ownedByCurrentTeam()->pluck('status')
            ->concat(Service::ownedByCurrentTeam()->get()->map(fn (Service $service) => $service->status))
            ->concat(Project::ownedByCurrentTeam()->get()->flatMap(fn (Project $project) => $project->databases()->pluck('status')));

        $tones = $statuses->map(fn (?string $status) => self::statusTone($status));

        return [
            'running' => $tones->filter(fn ($tone) => $tone === 'ok')->count(),
            'busy' => $tones->filter(fn ($tone) => $tone === 'busy')->count(),
            'stopped' => $tones->filter(fn ($tone) => $tone === 'bad')->count(),
            'total' => $tones->count(),
        ];
    }

    /**
     * @return array{ready: int, total: int}
     */
    #[Computed]
    public function serverHealth(): array
    {
        $servers = Server::ownedByCurrentTeam()->with('settings')->get();

        return [
            'ready' => $servers->filter(fn (Server $server) => $server->isFunctional())->count(),
            'total' => $servers->count(),
        ];
    }

    /**
     * Same reading of a stored status as the resources column: exited first, then health.
     */
    public static function statusTone(?string $status): string
    {
        $status = str($status);

        return match (true) {
            $status->startsWith('exited') => 'bad',
            $status->startsWith('running') && ! $status->contains('unhealthy') => 'ok',
            $status->startsWith(['starting', 'restarting', 'degraded']) || $status->contains('unhealthy') => 'busy',
            default => 'other',
        };
    }

    public function render(): View
    {
        return view('livewire.dashboard.overview');
    }

    /**
     * Finished deployments as a share of those that ended, in percent.
     *
     * @param  Collection<int, array{finished: int, failed: int}>  $days
     */
    private function successRate(Collection $days): ?int
    {
        $ended = $days->sum('finished') + $days->sum('failed');

        return $ended === 0 ? null : (int) round($days->sum('finished') / $ended * 100);
    }
}
