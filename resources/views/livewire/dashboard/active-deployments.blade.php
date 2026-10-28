@php
    $deploymentStatusMeta = function (string $status): array {
        $label = match ($status) {
            'finished' => 'Success',
            'in_progress' => 'In progress',
            'cancelled-by-user' => 'Cancelled',
            'queued' => 'Queued',
            'failed' => 'Failed',
            default => str($status)->headline()->toString(),
        };

        $tone = match ($status) {
            'finished' => 'is-ok',
            'in_progress', 'queued' => 'is-busy',
            'failed' => 'is-bad',
            default => '',
        };

        return [$label, $tone];
    };

    $hasActiveDeployments = $activeDeployments->isNotEmpty();
    $hasRecentDeployments = $recentDeployments->isNotEmpty();
    $hasAnyDeployments = $hasActiveDeployments || $hasRecentDeployments;
@endphp

<div wire:poll.3000ms="refreshDeployments" @class(['min-w-0', 'mb-0!' => $hasAnyDeployments, 'hidden' => ! $hasAnyDeployments])>
    @if ($hasAnyDeployments)
        {{-- A live console of deployments: active ones first, then the latest that ended. --}}
        <section class="pace-card min-w-0 overflow-hidden" aria-labelledby="dashboard-deployments-title">
            <header class="pace-card-head">
                <x-reicon name="terminal" class="size-4 shrink-0 text-[var(--pace-fg-muted)]" />
                <div class="min-w-0">
                    <h2 id="dashboard-deployments-title" class="pace-card-title">Deployments</h2>
                    @if ($hasActiveDeployments)
                        <p class="pace-card-desc">Running or queued right now</p>
                    @endif
                </div>
                <span class="ml-auto shrink-0 font-mono text-[12px] text-[var(--pace-fg-muted)]">
                    Last {{ $activeDeployments->count() + $recentDeployments->count() }}
                </span>
            </header>

            <div class="pace-feed">
                @foreach ($activeDeployments as $deployment)
                    @php
                        [$deploymentStatus, $deploymentTone] = $deploymentStatusMeta($deployment->status);
                        $environmentPath = collect([$deployment->application?->environment?->project?->name, $deployment->application?->environment?->name])->filter()->join(' / ');
                    @endphp
                    <a wire:key="dashboard-active-deployment-{{ $deployment->deployment_uuid }}"
                        href="{{ $deployment->deployment_url }}" {{ wireNavigate() }} class="pace-feed-row"
                        title="{{ $environmentPath ?: '-' }} · {{ $deployment->server_name ?: '-' }}">
                        <time class="pace-feed-time" datetime="{{ $deployment->created_at?->toIso8601String() }}">{{ $deployment->created_at?->format('H:i:s') ?? '-' }}</time>
                        <span class="pace-feed-dot {{ $deploymentTone }}" aria-hidden="true"></span>
                        <span class="pace-feed-name">{{ $deployment->application_name }}@if ($deployment->pull_request_id)<span>Pull request #{{ $deployment->pull_request_id }}</span>@elseif ($environmentPath)<span>{{ $environmentPath }}</span>@endif</span>
                        <span class="pace-feed-meta">{{ $deploymentStatus }}</span>
                    </a>
                @endforeach

                @if ($hasRecentDeployments)
                    {{-- The label separates Recent from Active; alone it would repeat the card title, so only screen readers get it. --}}
                    <h3 @class([
                        'px-2.5 pt-3 pb-1 text-[12px]! font-medium! text-[var(--pace-fg-muted)]!' => $hasActiveDeployments,
                        'sr-only' => ! $hasActiveDeployments,
                    ])>Recent deployments</h3>
                @endif

                @foreach ($recentDeployments as $deployment)
                    @php
                        [$deploymentStatus, $deploymentTone] = $deploymentStatusMeta($deployment->status);
                        $environmentPath = collect([$deployment->application?->environment?->project?->name, $deployment->application?->environment?->name])->filter()->join(' / ');
                        $duration = $deployment->finished_at && $deployment->created_at
                            ? $deployment->created_at->diffInSeconds($deployment->finished_at)
                            : null;
                    @endphp
                    <a wire:key="dashboard-recent-deployment-{{ $deployment->deployment_uuid }}"
                        href="{{ $deployment->deployment_url }}" {{ wireNavigate() }} class="pace-feed-row"
                        title="{{ $environmentPath ?: '-' }} · {{ $deployment->server_name ?: '-' }} · {{ $deployment->created_at?->diffForHumans() }}">
                        <time class="pace-feed-time" datetime="{{ $deployment->created_at?->toIso8601String() }}">{{ $deployment->created_at?->format('H:i:s') ?? '-' }}</time>
                        <span class="pace-feed-dot {{ $deploymentTone }}" aria-hidden="true"></span>
                        <span class="pace-feed-name">{{ $deployment->application_name }}@if ($deployment->pull_request_id)<span>Pull request #{{ $deployment->pull_request_id }}</span>@elseif ($environmentPath)<span>{{ $environmentPath }}</span>@endif</span>
                        <span class="pace-feed-meta">{{ $deploymentStatus }}@if ($duration !== null) · {{ $duration >= 60 ? intdiv((int) $duration, 60).'m '.((int) $duration % 60).'s' : (int) $duration.'s' }}@endif</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
