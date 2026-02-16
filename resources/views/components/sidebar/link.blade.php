{{-- Sidebar Navigation Link (Icon + Label, vertically stacked) --}}
@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
    'child' => false,
    'name' => null,
])

@php
    $isActive = $active;

    if ($child) {
        $baseClasses = 'flex flex-col items-center gap-1 py-2 rounded-lg transition-colors relative z-10';
        $activeClasses = $isActive
            ? 'text-white'
            : 'text-white/60 hover:text-white';
    } else {
        $baseClasses = 'flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors relative z-10';
        $activeClasses = $isActive
            ? 'text-white'
            : 'text-white/40 hover:text-white/60';
    }
@endphp

<a
    href="{{ $href }}"
    @if($name) data-nav-item="{{ $name }}" @endif
    @if($child && $name) x-on:click.prevent="highlight = '{{ $name }}'; setTimeout(() => Turbo.visit($el.href), 300)" @endif
    {{ $attributes->merge(['class' => "{$baseClasses} {$activeClasses}"]) }}
>
    @if($icon)
        <span class="{{ $child ? 'w-5 h-5' : 'w-7 h-7' }}">
            {{ $icon }}
        </span>
    @endif
    <span class="text-xs">{{ $slot }}</span>
</a>
