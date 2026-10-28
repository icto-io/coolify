<?php

namespace App\Livewire\Project\Application;

use App\Enums\ApplicationDeploymentStatus;
use App\Models\Application;
use App\Models\ApplicationDeploymentQueue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * The persistent log panel beside an application's pages: the log of its latest
 * deployment, followed live while that deployment runs.
 */
class LogPanel extends Component
{
    use AuthorizesRequests;

    /** Lines kept in the panel; the deployment page has the full log. */
    public const MAX_LINES = 300;

    public Application $application;

    public ?string $deploymentUuid = null;

    public ?string $status = null;

    public function mount(Application $application): void
    {
        $this->authorize('view', $application);
        $this->application = $application;
        $this->loadLatestDeployment();
    }

    /**
     * Picks up a new deployment and the progress of the current one.
     */
    public function polling(): void
    {
        $this->loadLatestDeployment();
        unset($this->deployment, $this->logLines);
    }

    public function isLive(): bool
    {
        return in_array($this->status, [
            ApplicationDeploymentStatus::QUEUED->value,
            ApplicationDeploymentStatus::IN_PROGRESS->value,
        ], true);
    }

    #[Computed]
    public function deployment(): ?ApplicationDeploymentQueue
    {
        if (is_null($this->deploymentUuid)) {
            return null;
        }

        return ApplicationDeploymentQueue::query()
            ->where('application_id', $this->application->id)
            ->where('deployment_uuid', $this->deploymentUuid)
            ->first();
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    #[Computed]
    public function logLines(): Collection
    {
        return decode_remote_command_output($this->deployment)->take(-self::MAX_LINES)->values();
    }

    public function render()
    {
        return view('livewire.project.application.log-panel');
    }

    private function loadLatestDeployment(): void
    {
        $deployment = ApplicationDeploymentQueue::query()
            ->where('application_id', $this->application->id)
            ->where('pull_request_id', 0)
            ->latest('id')
            ->first(['deployment_uuid', 'status']);

        $this->deploymentUuid = $deployment?->deployment_uuid;
        $this->status = $deployment?->status;
    }
}
