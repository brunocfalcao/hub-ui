{{-- Empty State Component --}}
{{-- Usage:
    <x-hub-ui::empty-state
        title="No servers yet"
        description="Get started by creating your first server."
        :action="['href' => route('servers.create'), 'label' => 'Create your first server']"
    >
        <x-slot:icon>
            <svg>...</svg>
        </x-slot:icon>
    </x-hub-ui::empty-state>
--}}
@props([
    'title',
    'description' => null,
    'action' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-16 text-center']) }}>
    @isset($icon)
        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
            <div class="w-8 h-8 text-white/30">
                {{ $icon }}
            </div>
        </div>
    @endisset

    <h3 class="text-lg font-medium text-white mb-1">{{ $title }}</h3>

    @if($description)
        <p class="text-sm text-white/40 mb-6">{{ $description }}</p>
    @endif

    @if($action)
        <a href="{{ $action['href'] }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/15 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            {{ $action['label'] }}
        </a>
    @endif
</div>
