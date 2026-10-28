<div>
    <x-slot:title>
        {{ data_get_str($application, 'name')->limit(10) }} > Configuration | Coolify
    </x-slot>
    <livewire:project.shared.configuration-checker :resource="$application" />
    <livewire:project.application.heading :application="$application" :wire:key="'application-heading-'.$currentRoute" />

    <section class="application-settings-workspace mt-4 w-full max-w-none lg:mt-0"
        x-data="{ logPanelOpen: (() => { try { return localStorage.getItem('logPanelOpen') !== 'false' } catch (e) { return true } })() }"
        @log-panel-toggle.window="logPanelOpen = !logPanelOpen; try { localStorage.setItem('logPanelOpen', logPanelOpen) } catch (e) {}"
        :class="logPanelOpen && 'has-log-panel'">
        <div class="workspace-grid grid min-w-0 gap-8 xl:grid-cols-[210px_minmax(0,1fr)] xl:gap-8">
            <x-application.configuration-sidebar :application="$application" :current-route="$currentRoute" />

            <div class="min-w-0">
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
            <aside class="log-panel-dock hidden xl:block" x-show="logPanelOpen" x-cloak>
                <livewire:project.application.log-panel :application="$application" :key="'log-panel-'.$application->uuid" />
            </aside>
        </div>
        <button type="button" class="log-panel-reopen hidden xl:flex" x-show="!logPanelOpen" x-cloak
            @click="$dispatch('log-panel-toggle')" aria-label="Show the deployment log">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 6h16M4 12h10M4 18h13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            <span>Log</span>
        </button>
    </section>
</div>
