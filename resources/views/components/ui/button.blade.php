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
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
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
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
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
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
