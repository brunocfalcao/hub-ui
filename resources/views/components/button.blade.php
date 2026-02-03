@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'href' => null,
])

@php
    $variants = [
        'primary' => 'bg-emerald-600 text-white hover:bg-emerald-500 focus:bg-emerald-500 active:bg-emerald-700 focus:ring-emerald-500',
        'secondary' => 'bg-white/5 text-white/70 border border-white/10 hover:bg-white/10 hover:text-white focus:ring-emerald-500',
        'danger' => 'bg-red-700 text-white hover:bg-red-600 active:bg-red-800 focus:ring-red-500',
        'ghost' => 'text-white/70 hover:bg-white/5 hover:text-white focus:ring-emerald-500',
        'link' => 'text-emerald-400 hover:text-emerald-300 underline-offset-4 hover:underline focus:ring-emerald-500',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-4 py-2 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-2.5',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];

    $baseClasses = "inline-flex items-center justify-center font-semibold uppercase tracking-widest rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#151b23] transition ease-in-out duration-150";

    if ($disabled || $loading) {
        $baseClasses .= " opacity-50 cursor-not-allowed";
    }

    $classes = "{$baseClasses} {$variantClass} {$sizeClass}";
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
