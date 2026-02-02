{{-- Sidebar Navigation Link (Icon + Label, vertically stacked) --}}
@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
    'child' => false,
])

@php
    $isActive = $active;

    if ($child) {
        // Child item styles - text highlight only, no background
        $baseClasses = 'flex flex-col items-center gap-1 py-2 rounded-lg transition-colors';
        $activeClasses = $isActive
            ? 'text-white'
            : 'text-white/60 hover:text-white';
    } else {
        // Parent item styles (larger icons, with background highlight)
        $baseClasses = 'flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors';
        $activeClasses = $isActive
            ? 'text-white bg-white/5'
            : 'text-white/40 hover:text-white/60 hover:bg-white/5';
    }
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "{$baseClasses} {$activeClasses}"]) }}
>
    @if($icon)
        <span class="{{ $child ? 'w-5 h-5' : 'w-7 h-7' }}">
            {{ $icon }}
        </span>
    @endif
    <span class="text-xs">{{ $slot }}</span>
</a>
