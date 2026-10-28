@php
    $days = $this->deploymentDays;
    $deployments = $this->deploymentStats;
    $resources = $this->resourceHealth;
    $servers = $this->serverHealth;

    // Sparkline: the area under the daily totals, scaled into a 100x40 box.
    $sparkMax = max(1, max($deployments['spark']));
    $sparkPoints = collect($deployments['spark'])->values()->map(fn ($value, $index) => [
        round($index / max(1, count($deployments['spark']) - 1) * 100, 2),
        round(38 - $value / $sparkMax * 34, 2),
    ]);
    // Smoothed like a monotone area: each segment bends through the midpoint between days.
    $sparkLine = $sparkPoints->map(function ($point, $index) use ($sparkPoints) {
        if ($index === 0) {
            return 'M'.$point[0].' '.$point[1];
        }
        $previous = $sparkPoints[$index - 1];
        $middle = round(($previous[0] + $point[0]) / 2, 2);

        return 'C'.$middle.' '.$previous[1].' '.$middle.' '.$point[1].' '.$point[0].' '.$point[1];
    })->join(' ');
    $sparkArea = $sparkLine.' L100 40 L0 40 Z';

    $deploymentDelta = $deployments['count'] - $deployments['previous'];
    $rateDelta = $deployments['rate'] !== null && $deployments['previous_rate'] !== null
        ? $deployments['rate'] - $deployments['previous_rate']
        : null;

    // Chart scale: a round ceiling so the four grid bands read as whole numbers.
    $chartMax = max(4, (int) ceil($days->max('total') / 4) * 4);
@endphp

<div class="flex min-w-0 flex-col gap-4" wire:poll.30s.visible>
    <div class="pace-stats">
        <article class="pace-stat">
            <header class="pace-stat-head">
                <h2>Deployments</h2>
                <x-reicon name="analytics" />
            </header>
            <div class="pace-stat-body">
                <div>
                    <div class="pace-stat-value">{{ $deployments['count'] }}</div>
                    <p class="pace-stat-note">
                        <span @class(['is-up' => $deploymentDelta > 0, 'is-down' => $deploymentDelta < 0])>{{ $deploymentDelta > 0 ? '+' : '' }}{{ $deploymentDelta }}</span>
                        vs previous 7 days
                    </p>
                </div>
                <svg class="pace-spark" viewBox="0 0 100 40" preserveAspectRatio="none" aria-hidden="true">
                    <defs>
                        <linearGradient id="pace-spark-fill" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stop-color="var(--pace-chart-2)" stop-opacity="0.4" />
                            <stop offset="95%" stop-color="var(--pace-chart-2)" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path d="{{ $sparkArea }}" fill="url(#pace-spark-fill)" />
                    <path d="{{ $sparkLine }}" fill="none" stroke="var(--pace-chart-2)" stroke-width="2"
                        vector-effect="non-scaling-stroke" stroke-linejoin="round" stroke-linecap="round" />
                </svg>
            </div>
        </article>

        <article class="pace-stat">
            <header class="pace-stat-head">
                <h2>Success rate</h2>
                <x-reicon name="check-circle" />
            </header>
            <div class="pace-stat-body">
                <div>
                    <div class="pace-stat-value">
                        @if ($deployments['rate'] === null)
                            <span class="text-[var(--pace-fg-muted)]">-</span>
                        @else
                            {{ $deployments['rate'] }}<small>%</small>
                        @endif
                    </div>
                    <p class="pace-stat-note">
                        @if ($rateDelta === null)
                            Last 7 days
                        @else
                            <span @class(['is-up' => $rateDelta > 0, 'is-down' => $rateDelta < 0])>{{ $rateDelta > 0 ? '+' : '' }}{{ $rateDelta }} pts</span>
                            vs previous 7 days
                        @endif
                    </p>
                </div>
                <div class="self-center">
                    <div class="pace-meter" role="img"
                        aria-label="{{ $days->slice(-7)->sum('finished') }} finished, {{ $days->slice(-7)->sum('failed') }} failed">
                        @foreach ($days->slice(-7) as $day)
                            <span @class([
                                'is-ok' => $day['total'] > 0 && $day['failed'] === 0,
                                'is-busy' => $day['failed'] > 0 && $day['finished'] > 0,
                                'is-bad' => $day['failed'] > 0 && $day['finished'] === 0,
                            ]) title="{{ $day['label'] }}: {{ $day['finished'] }} finished, {{ $day['failed'] }} failed"></span>
                        @endforeach
                    </div>
                    <p class="pace-stat-note">Each day this week</p>
                </div>
            </div>
        </article>

        <article class="pace-stat">
            <header class="pace-stat-head">
                <h2>Resources running</h2>
                <x-reicon name="layers" />
            </header>
            <div class="pace-stat-body">
                <div>
                    <div class="pace-stat-value">{{ $resources['running'] }}<small> / {{ $resources['total'] }}</small></div>
                    <p class="pace-stat-note">
                        @if ($resources['stopped'] > 0)
                            <span class="is-down">{{ $resources['stopped'] }} stopped</span>
                        @elseif ($resources['busy'] > 0)
                            {{ $resources['busy'] }} starting or unhealthy
                        @else
                            Applications, services, databases
                        @endif
                    </p>
                </div>
                <div class="self-center">
                    <div class="pace-meter" role="img"
                        aria-label="{{ $resources['running'] }} running, {{ $resources['busy'] }} starting or unhealthy, {{ $resources['stopped'] }} stopped">
                        @if ($resources['total'] === 0)
                            <span></span>
                        @else
                            @if ($resources['running'] > 0)
                                <span class="is-ok" style="flex-grow: {{ $resources['running'] }}"></span>
                            @endif
                            @if ($resources['busy'] > 0)
                                <span class="is-busy" style="flex-grow: {{ $resources['busy'] }}"></span>
                            @endif
                            @if ($resources['stopped'] > 0)
                                <span class="is-bad" style="flex-grow: {{ $resources['stopped'] }}"></span>
                            @endif
                            @if ($resources['total'] - $resources['running'] - $resources['busy'] - $resources['stopped'] > 0)
                                <span style="flex-grow: {{ $resources['total'] - $resources['running'] - $resources['busy'] - $resources['stopped'] }}"></span>
                            @endif
                        @endif
                    </div>
                    <p class="pace-stat-note">By stored state</p>
                </div>
            </div>
        </article>

        <article class="pace-stat">
            <header class="pace-stat-head">
                <h2>Servers ready</h2>
                <x-reicon name="servers" />
            </header>
            <div class="pace-stat-body">
                <div>
                    <div class="pace-stat-value">{{ $servers['ready'] }}<small> / {{ $servers['total'] }}</small></div>
                    <p class="pace-stat-note">
                        @if ($servers['total'] === 0)
                            No servers yet
                        @elseif ($servers['ready'] === $servers['total'])
                            <span class="is-up">All reachable</span>
                        @else
                            <span class="is-down">{{ $servers['total'] - $servers['ready'] }} need attention</span>
                        @endif
                    </p>
                </div>
                <div class="self-center">
                    <div class="pace-meter" aria-hidden="true">
                        @forelse (range(1, max(1, $servers['total'])) as $slot)
                            <span @class(['is-ok' => $slot <= $servers['ready'], 'is-bad' => $servers['total'] > 0 && $slot > $servers['ready']])></span>
                        @empty
                        @endforelse
                    </div>
                    <p class="pace-stat-note">Reachable and usable</p>
                </div>
            </div>
        </article>
    </div>

    <section class="pace-card" aria-labelledby="pace-deployments-chart-title"
        x-data="{ tip: null }" @mouseleave="tip = null">
        <header class="pace-card-head">
            <div class="min-w-0">
                <h2 id="pace-deployments-chart-title" class="pace-card-title">Deployment activity</h2>
                <p class="pace-card-desc">Deployments per day over the last {{ \App\Livewire\Dashboard\Overview::CHART_DAYS }} days, by outcome</p>
            </div>
            <div class="pace-legend" aria-hidden="true">
                <span><i style="background: var(--pace-chart-2)"></i>Finished</span>
                <span><i style="background: var(--pace-bad)"></i>Failed</span>
                <span><i style="background: var(--pace-chart-1)"></i>Other</span>
            </div>
        </header>
        <div class="pace-chart">
            <div class="pace-yaxis" aria-hidden="true">
                @foreach ([4, 3, 2, 1, 0] as $step)
                    <span>{{ (int) ($chartMax * $step / 4) }}</span>
                @endforeach
            </div>
            <div class="pace-bars" role="list">
                @foreach ($days as $index => $day)
                    <div class="pace-bar" role="listitem" wire:key="pace-day-{{ $day['date'] }}"
                        aria-label="{{ $day['label'] }}: {{ $day['finished'] }} finished, {{ $day['failed'] }} failed, {{ $day['other'] }} other"
                        @mouseenter="tip = { label: @js($day['label']), finished: {{ $day['finished'] }}, failed: {{ $day['failed'] }}, other: {{ $day['other'] }}, x: {{ ($index + 0.5) / $days->count() * 100 }} }">
                        @foreach (['finished' => 'is-ok', 'failed' => 'is-bad', 'other' => 'is-other'] as $key => $tone)
                            @if ($day[$key] > 0)
                                <span class="{{ $tone }}"
                                    style="height: {{ round($day[$key] / $chartMax * 100, 2) }}%; animation-delay: {{ $index * 25 }}ms"></span>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="pace-axis" aria-hidden="true">
                @foreach ($days as $index => $day)
                    <span @class(['max-sm:invisible' => $index % 2 === 1])>{{ $day['label'] }}</span>
                @endforeach
            </div>
            <div class="pace-tip" x-show="tip" x-cloak
                :style="tip && `left: calc(28px + 20px + (100% - 68px) * ${tip.x / 100}); top: 28px`">
                <p class="font-medium" x-text="tip?.label"></p>
                <p class="pace-tip-row"><i style="background: var(--pace-chart-2)"></i>Finished<b x-text="tip?.finished"></b></p>
                <p class="pace-tip-row"><i style="background: var(--pace-bad)"></i>Failed<b x-text="tip?.failed"></b></p>
                <p class="pace-tip-row"><i style="background: var(--pace-chart-1)"></i>Other<b x-text="tip?.other"></b></p>
            </div>
        </div>
    </section>
</div>
