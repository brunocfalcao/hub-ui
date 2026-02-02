@props([
    'type' => 'default',
    'size' => 'md',
    'dot' => false,
])

@php
    $colors = [
        'default' => 'bg-neutral-700 text-neutral-300',
        'primary' => 'bg-emerald-600 text-white',
        'success' => 'bg-green-600 text-white',
        'warning' => 'bg-amber-600 text-white',
        'danger' => 'bg-red-700 text-white',
        'info' => 'bg-blue-600 text-white',
        'online' => 'bg-green-500 text-white',
        'offline' => 'bg-neutral-600 text-neutral-300',
        'pending' => 'bg-emerald-600/80 text-emerald-100',
    ];

    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-0.5 text-sm',
        'lg' => 'px-3 py-1 text-sm',
    ];

    $dotColors = [
        'default' => 'bg-neutral-400',
        'primary' => 'bg-emerald-400',
        'success' => 'bg-green-400',
        'warning' => 'bg-amber-400',
        'danger' => 'bg-red-400',
        'info' => 'bg-blue-400',
        'online' => 'bg-green-300',
        'offline' => 'bg-neutral-400',
        'pending' => 'bg-emerald-300',
    ];

    $colorClass = $colors[$type] ?? $colors['default'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $dotColorClass = $dotColors[$type] ?? $dotColors['default'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full {$colorClass} {$sizeClass}"]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColorClass }} mr-1.5"></span>
    @endif
    {{ $slot }}
</span>
