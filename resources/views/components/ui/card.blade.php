@props([
    'title' => null,
    'subtitle' => null,
    'padding' => true,
    'footer' => null,
])

@php
    $bgColor = config('ui-skeleton.layout.colors.card', '#1a2332');
@endphp

<div {{ $attributes->merge(['class' => 'border border-white/10 rounded-lg shadow-lg overflow-hidden']) }} style="background-color: {{ $bgColor }}">
    @if($title || $subtitle)
        <div class="px-6 py-4 border-b border-white/10">
            @if($title)
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-sm text-white/60 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div @class(['px-6 py-4' => $padding])>
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-black/20 border-t border-white/10">
            {{ $footer }}
        </div>
    @endif
</div>
