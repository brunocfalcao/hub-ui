@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'href' => null,
])

@php
    $sizeClass = match($size) {
        'sm' => 'ui-btn-sm',
        'lg' => 'ui-btn-lg',
        default => 'ui-btn-md',
    };

    $classes = "ui-btn ui-btn-{$variant} {$sizeClass}";

    if ($disabled || $loading) {
        $classes .= ' opacity-50 cursor-not-allowed';
    }
@endphp

@if($href && !$disabled)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($loading)
            <x-hub-ui::spinner size="sm" />
        @elseif(isset($icon))
            {{ $icon }}
        @endif
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @if($disabled || $loading) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($loading)
            <x-hub-ui::spinner size="sm" />
        @elseif(isset($icon))
            {{ $icon }}
        @endif
        {{ $slot }}
    </button>
@endif
