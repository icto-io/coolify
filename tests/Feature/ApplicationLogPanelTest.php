<?php

use App\Enums\ApplicationDeploymentStatus;
use App\Livewire\Project\Application\LogPanel;
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
    InstanceSettings::forceCreate(['id' => 0]);

    $this->user = User::factory()->create();
    $this->team = Team::factory()->create();
    $this->team->members()->attach($this->user, ['role' => 'owner']);

    $server = Server::factory()->create(['team_id' => $this->team->id]);
    $destination = StandaloneDocker::factory()->create(['server_id' => $server->id, 'network' => 'log-panel-test']);
    $environment = Environment::factory()->create([
        'project_id' => Project::factory()->create(['team_id' => $this->team->id])->id,
    ]);

    $this->application = Application::factory()->create([
        'environment_id' => $environment->id,
        'destination_id' => $destination->id,
        'destination_type' => StandaloneDocker::class,
    ]);

    $this->actingAs($this->user);
});

function logPanelDeployment(Application $application, string $status, string $output, int $pullRequestId = 0): ApplicationDeploymentQueue
{
    return ApplicationDeploymentQueue::create([
        'application_id' => $application->id,
        'deployment_uuid' => fake()->uuid(),
        'commit' => 'abc1234',
        'status' => $status,
        'pull_request_id' => $pullRequestId,
        'logs' => json_encode([[
            'command' => null,
            'output' => $output,
            'type' => 'stdout',
            'timestamp' => '2026-10-27T12:00:00Z',
            'hidden' => false,
            'batch' => 1,
            'order' => 1,
        ]]),
    ]);
}

it('shows the log of the latest production deployment', function () {
    logPanelDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, 'older build output');
    $latest = logPanelDeployment($this->application, ApplicationDeploymentStatus::IN_PROGRESS->value, 'building image 3/5');
    logPanelDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, 'preview build output', pullRequestId: 7);

    Livewire::test(LogPanel::class, ['application' => $this->application])
        ->assertSet('deploymentUuid', $latest->deployment_uuid)
        ->assertSee('building image 3/5')
        ->assertDontSee('older build output')
        ->assertDontSee('preview build output')
        ->assertSee('Building');
});

it('follows a new deployment when polled', function () {
    logPanelDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, 'first deployment');

    $component = Livewire::test(LogPanel::class, ['application' => $this->application])
        ->assertSee('first deployment');

    $next = logPanelDeployment($this->application, ApplicationDeploymentStatus::QUEUED->value, 'second deployment');

    $component->call('polling')
        ->assertSet('deploymentUuid', $next->deployment_uuid)
        ->assertSee('second deployment');
});

it('shows an empty state when the application has never deployed', function () {
    Livewire::test(LogPanel::class, ['application' => $this->application])
        ->assertSet('deploymentUuid', null)
        ->assertSee('No deployments yet');
});

it('forbids users outside the application team', function () {
    logPanelDeployment($this->application, ApplicationDeploymentStatus::FINISHED->value, 'secret build output');

    $outsider = User::factory()->create();
    $otherTeam = Team::factory()->create();
    $otherTeam->members()->attach($outsider, ['role' => 'owner']);

    $this->actingAs($outsider);

    Livewire::test(LogPanel::class, ['application' => $this->application])
        ->assertForbidden();
});
