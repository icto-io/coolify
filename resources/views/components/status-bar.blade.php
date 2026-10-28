{{-- Bottom status bar: the team's servers at a glance. Reads stored state only, no remote calls. --}}
@php
    $statusBarServers = \App\Models\Server::ownedByCurrentTeam()->with('settings')->orderBy('name')->get();
@endphp
<footer class="app-status-bar hidden lg:flex" :class="collapsed ? 'lg:left-16' : 'lg:left-56'" aria-label="Server status">
    @forelse ($statusBarServers->take(4) as $statusBarServer)
        @php
            $statusBarProxy = data_get($statusBarServer->proxy, 'status');
        @endphp
        <a href="{{ route('server.show', ['server_uuid' => $statusBarServer->uuid]) }}" {{ wireNavigate() }}
            class="app-status-bar-item">
            <span @class([
                'app-status-bar-dot',
                'is-ok' => $statusBarServer->isFunctional(),
                'is-bad' => ! $statusBarServer->isFunctional(),
            ]) aria-hidden="true"></span>
            <span class="font-medium text-[var(--gp-fg)]">{{ $statusBarServer->name }}</span>
            <span>{{ $statusBarServer->isFunctional() ? 'Online' : 'Unreachable' }}</span>
            @if ($statusBarProxy)
                <span class="app-status-bar-sep" aria-hidden="true"></span>
                <span>Proxy {{ $statusBarProxy }}</span>
            @endif
        </a>
    @empty
        <a href="{{ route('server.index') }}" {{ wireNavigate() }} class="app-status-bar-item">No servers yet</a>
    @endforelse
    @if ($statusBarServers->count() > 4)
        <a href="{{ route('server.index') }}" {{ wireNavigate() }} class="app-status-bar-item">
            +{{ $statusBarServers->count() - 4 }} more
        </a>
    @endif
    <span class="ml-auto font-mono">v{{ config('constants.coolify.version') }}</span>
</footer>
