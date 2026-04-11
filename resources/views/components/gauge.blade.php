@props([
    'value' => 0,
    'max' => 100,
    'size' => 'md',
    'color' => null,
    'label' => null,
    'sublabel' => null,
    'thickness' => null,
])

@php
    $pct = $max > 0 ? min(100, round(($value / $max) * 100)) : 0;

    $sizes = [
        'xs' => ['w' => 'w-10 h-10', 'text' => 'text-[10px]', 'sub' => 'text-[8px]', 'r' => 38, 'stroke' => 6],
        'sm' => ['w' => 'w-14 h-14', 'text' => 'text-xs', 'sub' => 'text-[9px]', 'r' => 40, 'stroke' => 8],
        'md' => ['w' => 'w-24 h-24', 'text' => 'text-lg', 'sub' => 'text-[10px]', 'r' => 42, 'stroke' => 8],
        'lg' => ['w' => 'w-32 h-32', 'text' => 'text-2xl', 'sub' => 'text-xs', 'r' => 42, 'stroke' => 10],
        'xl' => ['w' => 'w-44 h-44', 'text' => 'text-3xl', 'sub' => 'text-xs', 'r' => 42, 'stroke' => 8],
    ];

    $s = $sizes[$size] ?? $sizes['md'];
    $r = $s['r'];
    $strokeWidth = $thickness ?? $s['stroke'];
    $circumference = 2 * 3.14159 * $r;
    $dasharray = ($pct / 100) * $circumference;

    $colorStyle = $color ? "stroke: {$color}" : 'stroke: rgb(var(--ui-primary))';
@endphp

<div {{ $attributes->merge(['class' => 'relative ' . $s['w']]) }}>
    <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="{{ $r }}" fill="none" stroke="rgb(var(--ui-border))" stroke-width="{{ $strokeWidth }}" />
        <circle
            cx="50" cy="50" r="{{ $r }}"
            fill="none"
            style="{{ $colorStyle }}"
            stroke-width="{{ $strokeWidth }}"
            stroke-linecap="round"
            stroke-dasharray="{{ $dasharray }} {{ $circumference }}"
            class="transition-all duration-700 ease-out"
        />
    </svg>
    <div class="absolute inset-0 flex flex-col items-center justify-center">
        @if($label)
            <span class="{{ $s['text'] }} font-bold ui-text" style="{{ $color ? "color: {$color}" : '' }}">{{ $label }}</span>
        @else
            <span class="{{ $s['text'] }} font-bold ui-text" style="{{ $color ? "color: {$color}" : '' }}">{{ $pct }}%</span>
        @endif
        @if($sublabel)
            <span class="{{ $s['sub'] }} ui-text-subtle">{{ $sublabel }}</span>
        @endif
        {{ $slot }}
    </div>
</div>
