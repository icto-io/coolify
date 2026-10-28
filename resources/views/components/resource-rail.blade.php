@props(['environment', 'activeUuid' => null])

{{-- Resources column: every resource of the environment with its stored status. Read-only. --}}
@php
    $railResources = $environment->applications->sortBy('name', SORT_NATURAL)
        ->concat($environment->services->sortBy('name', SORT_NATURAL))
        ->concat($environment->databases()->sortBy('name', SORT_NATURAL));
    $railTone = fn (?string $status) => match (true) {
        str($status)->startsWith('exited') => 'is-bad',
        str($status)->startsWith('running') && ! str($status)->contains('unhealthy') => 'is-ok',
        str($status)->startsWith(['starting', 'restarting', 'degraded']) || str($status)->contains('unhealthy') => 'is-busy',
        default => '',
    };
    $railType = fn ($resource) => match (true) {
        $resource instanceof \App\Models\Application => ['nixpacks' => 'Nixpacks', 'railpack' => 'Railpack', 'static' => 'Static', 'dockerfile' => 'Dockerfile', 'dockercompose' => 'Docker Compose', 'dockerimage' => 'Docker Image'][$resource->build_pack] ?? str($resource->build_pack)->headline()->toString(),
        $resource instanceof \App\Models\Service => 'Service',
        default => str(class_basename($resource))->after('Standalone')->headline()->toString(),
    };
@endphp
<nav class="resource-rail" aria-label="Resources in {{ $environment->name }}">
    <header class="resource-rail-head">
        <h2>Resources</h2>
        <span class="tabular-nums">{{ $railResources->count() }}</span>
    </header>
    <ul class="resource-rail-list">
        @foreach ($railResources as $railResource)
            @php
                $railStatus = str($railResource->status)->before(':')->headline()->toString();
            @endphp
            <li>
                <a href="{{ $railResource->link() }}" {{ wireNavigate() }}
                    @class(['resource-rail-item', 'is-active' => $railResource->uuid === $activeUuid])
                    @if ($railResource->uuid === $activeUuid) aria-current="page" @endif>
                    <span class="resource-rail-name">{{ $railResource->name }}</span>
                    <span class="resource-rail-status {{ $railTone($railResource->status) }}">
                        <span class="resource-rail-dot" aria-hidden="true"></span>{{ $railStatus ?: 'Unknown' }}
                    </span>
                    <span class="resource-rail-meta">{{ $railType($railResource) }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('project.resource.index', ['project_uuid' => $environment->project->uuid, 'environment_uuid' => $environment->uuid]) }}"
        {{ wireNavigate() }} class="resource-rail-foot">All of {{ $environment->name }}</a>
</nav>
