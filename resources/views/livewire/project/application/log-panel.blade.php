@php
    $deployment = $this->deployment;
    $isLive = $this->isLive();
    $statusLabel = match ($status) {
        'queued' => 'Queued',
        'in_progress' => 'Building',
        'finished' => 'Finished',
        'failed' => 'Failed',
        'cancelled-by-user' => 'Cancelled',
        default => null,
    };
    $statusTone = match ($status) {
        'queued', 'in_progress' => 'is-busy',
        'finished' => 'is-ok',
        'failed' => 'is-bad',
        default => '',
    };
    $deploymentRoute = $deployment
        ? route('project.application.deployment.show', [
            'project_uuid' => $application->environment->project->uuid,
            'environment_uuid' => $application->environment->uuid,
            'application_uuid' => $application->uuid,
            'deployment_uuid' => $deployment->deployment_uuid,
        ])
        : null;
@endphp
<section class="log-panel" aria-label="Deployment log"
    @if ($isLive) wire:poll.2000ms="polling" @else wire:poll.20s="polling" @endif
    x-data="{
        follow: true,
        filter: 'all',
        scrollToEnd() {
            if (!this.follow) return;
            const body = this.$refs.body;
            if (body) body.scrollTop = body.scrollHeight;
        },
        onScroll() {
            const body = this.$refs.body;
            this.follow = body.scrollHeight - body.scrollTop - body.clientHeight < 24;
        },
    }"
    x-init="$nextTick(() => scrollToEnd()); new MutationObserver(() => scrollToEnd()).observe($refs.body, { childList: true, subtree: true })">
    <header class="log-panel-head">
        <h2 class="log-panel-title">Deployment log</h2>
        @if ($statusLabel)
            <span class="log-panel-status {{ $statusTone }}">
                <span class="log-panel-dot" aria-hidden="true"></span>{{ $statusLabel }}
            </span>
        @endif
        <div class="ml-auto flex items-center gap-1">
            @if ($deploymentRoute)
                <a href="{{ $deploymentRoute }}" {{ wireNavigate() }} class="log-panel-action" title="Open the full log">
                    Full log
                </a>
            @endif
            <button type="button" class="log-panel-action" @click="$dispatch('log-panel-toggle')" title="Hide the log panel"
                aria-label="Hide the log panel">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </header>

    @if ($deployment)
        <div class="log-panel-meta">
            @if ($deployment->commit && $deployment->commit !== 'HEAD')
                <span class="font-mono text-[var(--gp-fg)]">{{ str($deployment->commit)->limit(7, '') }}</span>
            @endif
            @if ($deployment->commitMessage())
                <span class="min-w-0 truncate">{{ str($deployment->commitMessage())->limit(60) }}</span>
            @endif
            <span class="ml-auto shrink-0">{{ $deployment->created_at->diffForHumans() }}</span>
        </div>
        <div class="log-panel-filters" role="group" aria-label="Filter log lines">
            <button type="button" class="log-panel-filter" :class="filter === 'all' && 'is-active'" @click="filter = 'all'"
                :aria-pressed="(filter === 'all').toString()">All</button>
            <button type="button" class="log-panel-filter" :class="filter === 'warnings' && 'is-active'" @click="filter = 'warnings'"
                :aria-pressed="(filter === 'warnings').toString()">Warnings <span class="log-panel-count">{{ $this->lineCounts['warnings'] }}</span></button>
            <button type="button" class="log-panel-filter" :class="filter === 'errors' && 'is-active'" @click="filter = 'errors'"
                :aria-pressed="(filter === 'errors').toString()">Errors <span class="log-panel-count">{{ $this->lineCounts['errors'] }}</span></button>
            <label class="ml-auto inline-flex cursor-pointer items-center gap-1.5 text-[12px] text-[var(--gp-fg-dim)]">
                <input type="checkbox" class="log-panel-follow" x-model="follow" @change="scrollToEnd()">
                Follow
            </label>
        </div>
    @endif

    <div class="log-panel-body" x-ref="body" @scroll.passive="onScroll()" :class="filter !== 'all' && 'only-' + filter">
        @forelse ($this->logLines as $line)
            <div @class([
                'log-panel-line',
                'is-command' => ! empty($line['command']),
                'is-stderr' => ! empty($line['stderr']),
                'is-warning' => \App\Livewire\Project\Application\LogPanel::isWarning($line),
                'is-hidden' => ! empty($line['hidden']),
            ])>
                <span class="log-panel-time">{{ str($line['timestamp'])->afterLast(' ')->before('.') }}</span>
                <span class="log-panel-text">{{ ! empty($line['command']) ? '$ ' : '' }}{{ trim($line['line']) }}</span>
            </div>
        @empty
            <p class="log-panel-empty">
                @if ($deployment)
                    No log lines yet.
                @else
                    No deployments yet. The log of the next deployment appears here.
                @endif
            </p>
        @endforelse
    </div>

    @if ($deployment)
        <footer class="log-panel-foot">
            <span>{{ $this->logLines->count() }} {{ str('line')->plural($this->logLines->count()) }}@if ($this->logLines->count() >= \App\Livewire\Project\Application\LogPanel::MAX_LINES), latest shown @endif<span x-show="follow && {{ $isLive ? 'true' : 'false' }}"> · following</span></span>
            @if ($deployment->commit && $deployment->commit !== 'HEAD')
                <span class="font-mono">{{ str($deployment->commit)->limit(7, '') }}</span>
            @endif
        </footer>
    @endif
</section>
