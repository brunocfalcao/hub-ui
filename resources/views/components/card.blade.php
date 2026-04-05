@props([
    'title' => null,
    'subtitle' => null,
    'padding' => true,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'ui-card overflow-hidden shadow-lg']) }}>
    @if($title || $subtitle)
        <div class="px-8 py-5 ui-card-header">
            @if($title)
                <h3 class="text-lg font-semibold ui-text">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-sm ui-text-muted mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div @class(['px-8 py-7' => $padding])>
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-8 py-5 ui-card-footer" style="background-color: rgb(0 0 0 / 0.15)">
            {{ $footer }}
        </div>
    @endif
</div>
