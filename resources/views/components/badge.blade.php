@props([
    'type' => 'default',
    'size' => 'md',
    'dot' => false,
])

@php
    $sizeClass = match($size) {
        'sm' => 'px-2 py-0.5 text-xs',
        'lg' => 'px-3 py-1 text-sm',
        default => 'px-2.5 py-0.5 text-sm',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full ui-badge-{$type} {$sizeClass}"]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full mr-1.5" style="background-color: currentColor; opacity: 0.7"></span>
    @endif
    {{ $slot }}
</span>
