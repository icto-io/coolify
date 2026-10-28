<div>
    <x-slot:title>
        {{ data_get_str($application, 'name')->limit(10) }} > Configuration | Coolify
    </x-slot>
    <livewire:project.shared.configuration-checker :resource="$application" />
    <livewire:project.application.heading :application="$application" :wire:key="'application-heading-'.$currentRoute" />

    <section class="application-settings-workspace mt-4 w-full max-w-none lg:mt-0"
        x-data="{
            // Wide screens dock the log beside the page (remembered); narrower ones open it as an overlay.
            logPanelOpen: (() => { try { return localStorage.getItem('logPanelOpen') !== 'false' } catch (e) { return true } })(),
            logOverlay: false,
            wide: window.matchMedia('(min-width: 1280px)').matches,
            init() {
                window.matchMedia('(min-width: 1280px)').addEventListener('change', (event) => this.wide = event.matches);
            },
            toggleLog() {
                if (!this.wide) { this.logOverlay = !this.logOverlay; return; }
                this.logPanelOpen = !this.logPanelOpen;
                try { localStorage.setItem('logPanelOpen', this.logPanelOpen) } catch (e) {}
            },
        }"
        @log-panel-toggle.window="toggleLog()" @keydown.escape.window="logOverlay = false"
        :class="wide && logPanelOpen && 'has-log-panel'">
        <div class="workspace-grid grid min-w-0 gap-8 xl:grid-cols-[210px_minmax(0,1fr)] xl:gap-8">
            <x-application.configuration-sidebar :application="$application" :current-route="$currentRoute" />

            {{-- Wide screens tile the workspace: resources, the selected application, its log. --}}
            <div class="resource-rail-dock hidden xl:block">
                <x-resource-rail :environment="$application->environment" :active-uuid="$application->uuid" />
            </div>

            <div class="workspace-centre min-w-0">
            @php
                $summaryDomains = str($application->fqdn)->explode(',')->map(fn ($domain) => trim($domain))->filter();
            @endphp
            <header class="resource-summary hidden xl:flex">
                <div class="flex min-w-0 items-center gap-3">
                    <h1 class="resource-summary-name">{{ $application->name }}</h1>
                    <x-status-summary :status="$application->status" />
                    <span class="resource-summary-chip">{{ ['nixpacks' => 'Nixpacks', 'railpack' => 'Railpack', 'static' => 'Static', 'dockerfile' => 'Dockerfile', 'dockercompose' => 'Docker Compose', 'dockerimage' => 'Docker Image'][$application->build_pack] ?? str($application->build_pack)->headline() }}</span>
                </div>
                <dl class="resource-summary-facts">
                    @if ($summaryDomains->isNotEmpty())
                        <div>
                            <dt>Domain</dt>
                            <dd>
                                <a href="{{ $summaryDomains->first() }}" target="_blank" rel="noopener noreferrer">{{ str($summaryDomains->first())->after('://') }}</a>
                                @if ($summaryDomains->count() > 1)
                                    <span class="text-[var(--gp-fg-faint)]">+{{ $summaryDomains->count() - 1 }}</span>
                                @endif
                            </dd>
                        </div>
                    @endif
                    @if ($application->git_repository)
                        <div>
                            <dt>Source</dt>
                            <dd class="font-mono">{{ str($application->git_repository)->afterLast(':')->replace('.git', '') }}@if ($application->git_branch)<span class="text-[var(--gp-fg-faint)]">:{{ $application->git_branch }}</span>@endif</dd>
                        </div>
                    @endif
                    <div>
                        <dt>Server</dt>
                        <dd>{{ $application->destination?->server?->name }}</dd>
                    </div>
                    <div>
                        <dt>UUID</dt>
                        <dd class="font-mono">{{ $application->uuid }}</dd>
                    </div>
                </dl>
            </header>
            @if ($currentRoute === 'project.application.configuration')
                <livewire:project.application.general :application="$application" />
            @elseif ($currentRoute === 'project.application.domains')
                <livewire:project.application.domains :application="$application" />
                <livewire:project.shared.maintenance :resource="$application" />
            @elseif ($currentRoute === 'project.application.swarm' && $application->destination->server->isSwarm())
                <livewire:project.application.swarm :application="$application" />
            @elseif ($currentRoute === 'project.application.advanced')
                <livewire:project.application.advanced :application="$application" />
            @elseif ($currentRoute === 'project.application.environment-variables')
                <livewire:project.shared.environment-variable.all :resource="$application" />
                <livewire:project.shared.secret-manager-links :resource="$application" />
            @elseif ($currentRoute === 'project.application.persistent-storage')
                <livewire:project.service.storage :resource="$application" />
            @elseif ($currentRoute === 'project.application.source' && $application->git_based())
                <livewire:project.application.source :application="$application" />
            @elseif ($currentRoute === 'project.application.servers')
                <livewire:project.shared.destination :resource="$application" />
            @elseif ($currentRoute === 'project.application.scheduled-tasks.show')
                <livewire:project.shared.scheduled-task.all :resource="$application" />
            @elseif ($currentRoute === 'project.application.webhooks')
                <livewire:project.shared.webhooks :resource="$application" />
            @elseif ($currentRoute === 'project.application.preview-deployments')
                <livewire:project.application.previews :application="$application" />
            @elseif ($currentRoute === 'project.application.healthcheck' && $application->build_pack !== 'dockercompose')
                <livewire:project.shared.health-checks :resource="$application" />
            @elseif ($currentRoute === 'project.application.rollback')
                <livewire:project.application.rollback :application="$application" />
            @elseif ($currentRoute === 'project.application.resource-limits')
                <livewire:project.shared.resource-limits :resource="$application" />
            @elseif ($currentRoute === 'project.application.resource-operations')
                <livewire:project.shared.resource-operations :resource="$application" />
            @elseif ($currentRoute === 'project.application.metrics')
                <livewire:project.shared.metrics :resource="$application" />
            @elseif ($currentRoute === 'project.application.analytics')
                <livewire:project.application.analytics :application="$application"
                    :lazy="$application->destination?->server?->isTrafficAnalyticsEnabled()" />
            @elseif ($currentRoute === 'project.application.tags')
                <livewire:project.shared.tags :resource="$application" />
            @elseif ($currentRoute === 'project.application.danger')
                <livewire:project.shared.danger :resource="$application" />
            @endif
            </div>
            <aside class="log-panel-dock hidden lg:block" :class="!wide && 'is-overlay'" x-show="wide ? logPanelOpen : logOverlay" x-cloak>
                <livewire:project.application.log-panel :application="$application" :key="'log-panel-'.$application->uuid" />
            </aside>
        </div>
        <button type="button" class="log-panel-reopen hidden lg:flex" x-show="wide ? !logPanelOpen : !logOverlay" x-cloak
            @click="$dispatch('log-panel-toggle')" aria-label="Show the deployment log">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 6h16M4 12h10M4 18h13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            <span>Log</span>
        </button>
    </section>
</div>
