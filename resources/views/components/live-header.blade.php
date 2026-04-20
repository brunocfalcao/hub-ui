@props([
    'title',
    'description' => null,
    'subtitle' => null,
    'live' => true,
    'refreshSeconds' => 5,
    'lastUpdatedModel' => null,
    'size' => 'md',
])

@php
    $titleClass = $size === 'lg'
        ? 'text-xl font-semibold tracking-tight ui-text'
        : 'text-base font-semibold tracking-tight ui-text';
@endphp

<div {{ $attributes->merge(['class' => 'px-6 py-4 border-b ui-border ui-bg-body']) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-3">
                <h1 class="{{ $titleClass }}">{{ $title }}</h1>
                @if($subtitle)
                    <span class="text-xs ui-text-subtle">{{ $subtitle }}</span>
                @endif
            </div>
            @if($description)
                <p class="text-xs ui-text-subtle mt-0.5">{{ $description }}</p>
            @endif
        </div>

        <div class="flex items-center gap-3 flex-shrink-0">
            @isset($actions)
                {{ $actions }}
            @endisset

            @if($live)
                <div class="flex items-center gap-2 pl-3 border-l ui-border">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 ui-bg-success"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 ui-bg-success"></span>
                    </span>
                    <span class="text-[10px] font-medium uppercase tracking-wider ui-text-subtle">LIVE · {{ $refreshSeconds }}s</span>
                </div>

                @if($lastUpdatedModel)
                    <span x-show="{{ $lastUpdatedModel }}" class="text-[10px] ui-text-subtle font-mono tabular-nums" x-text="{{ $lastUpdatedModel }}"></span>
                @endif
            @endif
        </div>
    </div>
</div>
