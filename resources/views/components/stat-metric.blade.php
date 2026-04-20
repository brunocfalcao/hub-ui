@props([
    'label' => null,
    'color' => 'default',
    'value' => null,
    'size' => 'md',
])

@php
    $colorStyle = match($color) {
        'primary' => 'color: rgb(var(--ui-primary))',
        'success' => 'color: rgb(var(--ui-success))',
        'warning' => 'color: rgb(var(--ui-warning))',
        'danger'  => 'color: rgb(var(--ui-danger))',
        'info'    => 'color: rgb(var(--ui-info))',
        'muted'   => 'color: rgb(var(--ui-text-subtle))',
        default   => 'color: rgb(var(--ui-text))',
    };

    $valueSize = match($size) {
        'sm' => 'text-lg',
        'lg' => 'text-3xl',
        default => 'text-2xl',
    };
@endphp

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <div class="{{ $valueSize }} font-bold" style="{{ $colorStyle }}">
        @if($value !== null)
            {{ $value }}
        @else
            {{ $slot }}
        @endif
    </div>
    @if($label)
        <div class="text-xs ui-text-subtle">{{ $label }}</div>
    @endif
</div>
