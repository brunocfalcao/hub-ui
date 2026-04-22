{{-- Empty State Component --}}
@props([
    'title',
    'description' => null,
    'action' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-8 sm:py-12 md:py-16 px-4 text-center']) }}>
    @isset($icon)
        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 ui-bg-elevated">
            <div class="w-8 h-8 ui-text-subtle">
                {{ $icon }}
            </div>
        </div>
    @endisset

    <h3 class="text-lg font-medium ui-text mb-1">{{ $title }}</h3>

    @if($description)
        <p class="text-sm ui-text-subtle mb-6">{{ $description }}</p>
    @endif

    @if($action)
        <a href="{{ $action['href'] }}"
           class="ui-btn ui-btn-secondary ui-btn-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ $action['label'] }}
        </a>
    @endif
</div>
