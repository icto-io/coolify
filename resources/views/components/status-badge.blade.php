@props([
    'label' => null,
    'status' => null,
    'type' => 'neutral',
    'as' => 'span',
    'dynamic' => false,
    'pulse' => false, // ping the dot for a state that is still in progress
])

@php
    $dotClasses = [
        'neutral' => 'bg-neutral-400 dark:bg-neutral-500',
        'success' => 'bg-emerald-500',
        'warning' => 'bg-warning',
        'error' => 'bg-red-500',
    ];

    // Indicator lamp: lit (and pulsing while in progress) only when live.
    $lampClasses = 'status-lamp status-lamp-'.(array_key_exists($type, $dotClasses) ? $type : 'neutral').($pulse ? ' status-lamp-pulse' : '');

    $baseClasses = 'status-badge inline-flex h-6 max-w-full items-center gap-1.5 whitespace-nowrap rounded-full border border-neutral-200 bg-neutral-100 px-2 text-xs font-medium leading-none text-neutral-700 dark:border-white/[0.12] dark:bg-white/[0.07] dark:text-white';
@endphp

@if ($as === 'button')
    <button {{ $attributes->class([$baseClasses, 'transition-colors'])->merge(['type' => 'button']) }}>
        @if ($dynamic)
            {{ $slot }}
        @else
            <span class="{{ $lampClasses }}" aria-hidden="true"></span>
            <span class="truncate">{{ collect([$label, $status])->filter()->join(' ') }}</span>
        @endif
    </button>
@elseif ($as === 'a')
    <a {{ $attributes->class([$baseClasses, 'transition-colors']) }}>
        @if ($dynamic)
            {{ $slot }}
        @else
            <span class="{{ $lampClasses }}" aria-hidden="true"></span>
            <span class="truncate">{{ collect([$label, $status])->filter()->join(' ') }}</span>
        @endif
    </a>
@else
    <span {{ $attributes->class([$baseClasses]) }}>
        @if ($dynamic)
            {{ $slot }}
        @else
            <span class="{{ $lampClasses }}" aria-hidden="true"></span>
            <span class="truncate">{{ collect([$label, $status])->filter()->join(' ') }}</span>
        @endif
    </span>
@endif
