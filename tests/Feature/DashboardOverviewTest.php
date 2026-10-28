<?php

use App\Enums\ApplicationDeploymentStatus;
use App\Livewire\Dashboard\Overview;
use App\Models\Application;
use App\Models\ApplicationDeploymentQueue;
use App\Models\Environment;
use App\Models\InstanceSettings;
use App\Models\Project;
use App\Models\Server;
use App\Models\StandaloneDocker;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    InstanceSettings::unguarded(fn () => InstanceSettings::query()->create(['id' => 0]));

    $this->user = User::factory()->create();
    $this->team = Team::factory()->create();
    $this->user->teams()->attach($this->team, ['role' => 'owner']);

    $this->actingAs($this->user);
    session(['currentTeam' => $this->team]);

    $this->server = Server::factory()->create(['team_id' => $this->team->id]);
    $this->destination = StandaloneDocker::query()->where('server_id', $this->server->id)->firstOrFail();
    $this->environment = Environment::factory()->create([
        'project_id' => Project::factory()->create(['team_id' => $this->team->id])->id,
    ]);
    $this->application = overviewApplication($this->environment, $this->destination, 'running:healthy');
});

function overviewApplication(Environment $environment, StandaloneDocker $destination, string $status): Application
{
    return Application::factory()->create([
        'environment_id' => $environment->id,
        'destination_id' => $destination->id,
        'destination_type' => $destination->getMorphClass(),
        'status' => $status,
    ]);
}

function overviewDeployment(Application $application, string $status, string $createdAt): ApplicationDeploymentQueue
{
    $deployment = ApplicationDeploymentQueue::create([
        'application_id' => $application->id,
        'application_name' => $application->name,
        'deployment_uuid' => fake()->uuid(),
        'status' => $status,
        'pull_request_id' => 0,
    ]);
    $deployment->forceFill(['created_at' => $createdAt])->save();

    return $deployment;
}

it('counts deployments per day by outcome over two weeks', function () {
    $this->travelTo(now()->setDate(2026, 10, 28)->setTime(15, 0));

    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, '2026-10-28 09:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FAILED->value, '2026-10-28 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::CANCELLED_BY_USER->value, '2026-10-27 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, '2026-10-01 10:00:00');

    $days = Livewire::test(Overview::class)->instance()->deploymentDays;

    expect($days)->toHaveCount(Overview::CHART_DAYS)
        ->and($days->first()['date'])->toBe('2026-10-15')
        ->and($days->last())->toMatchArray(['date' => '2026-10-28', 'finished' => 1, 'failed' => 1, 'other' => 0, 'total' => 2])
        ->and($days[12])->toMatchArray(['date' => '2026-10-27', 'other' => 1, 'total' => 1])
        ->and($days->sum('total'))->toBe(3);
});

it('compares this week with the previous one', function () {
    $this->travelTo(now()->setDate(2026, 10, 28)->setTime(15, 0));

    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, '2026-10-27 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, '2026-10-26 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, '2026-10-25 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FAILED->value, '2026-10-24 10:00:00');
    overviewDeployment($this->application, ApplicationDeploymentStatus::FAILED->value, '2026-10-18 10:00:00');

    $stats = Livewire::test(Overview::class)->instance()->deploymentStats;

    expect($stats)->toMatchArray(['count' => 4, 'previous' => 1, 'rate' => 75, 'previous_rate' => 0]);
});

it('leaves the success rate empty when no deployment ended', function () {
    overviewDeployment($this->application, ApplicationDeploymentStatus::IN_PROGRESS->value, now()->toDateTimeString());

    Livewire::test(Overview::class)
        ->tap(fn ($component) => expect($component->instance()->deploymentStats['rate'])->toBeNull())
        ->assertSee('Success rate')
        ->assertSee('Last 7 days');
});

it('only counts deployments and resources of the current team', function () {
    $otherTeam = Team::factory()->create();
    $otherEnvironment = Environment::factory()->create([
        'project_id' => Project::factory()->create(['team_id' => $otherTeam->id])->id,
    ]);
    $otherServer = Server::factory()->create(['team_id' => $otherTeam->id]);
    $otherDestination = StandaloneDocker::query()->where('server_id', $otherServer->id)->firstOrFail();
    $otherApplication = overviewApplication($otherEnvironment, $otherDestination, 'exited');

    overviewDeployment($otherApplication, ApplicationDeploymentStatus::FAILED->value, now()->toDateTimeString());
    overviewDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, now()->toDateTimeString());

    $overview = Livewire::test(Overview::class)->instance();

    expect($overview->deploymentStats['count'])->toBe(1)
        ->and($overview->deploymentStats['rate'])->toBe(100)
        ->and($overview->resourceHealth)->toMatchArray(['running' => 1, 'stopped' => 0, 'total' => 1])
        ->and($overview->serverHealth['total'])->toBe(1);
});

it('sorts resources by stored state', function () {
    overviewApplication($this->environment, $this->destination, 'exited');
    overviewApplication($this->environment, $this->destination, 'running:unhealthy');
    overviewApplication($this->environment, $this->destination, 'restarting');

    expect(Livewire::test(Overview::class)->instance()->resourceHealth)
        ->toBe(['running' => 1, 'busy' => 2, 'stopped' => 1, 'total' => 4]);
});

it('renders on the dashboard', function () {
    Team::query()->update(['show_boarding' => false]);

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertSeeLivewire(Overview::class);
});
