{{-- Sidebar Navigation Link (Icon + Label, vertically stacked) --}}
@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
    'child' => false,
    'name' => null,
])

@php
    $baseClasses = $child
        ? 'flex flex-col items-center gap-1 py-2 rounded-lg transition-colors relative z-10'
        : 'flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors relative z-10';
@endphp

<a
    href="{{ $href }}"
    @if($name) data-nav-item="{{ $name }}" @endif
    {{ $attributes->merge(['class' => $baseClasses]) }}
    :class="highlight === '{{ $name }}' ? 'ui-sidebar-text-active' : 'ui-sidebar-text hover:ui-text-muted'"
>
    @if($icon)
        <span class="{{ $child ? 'w-5 h-5' : 'w-7 h-7' }}">
            {{ $icon }}
        </span>
    @endif
    <span class="text-xs">{{ $slot }}</span>
</a>
