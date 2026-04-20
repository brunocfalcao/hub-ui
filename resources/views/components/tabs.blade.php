@props([
    'tabs' => [],
    'active' => 'activeTab',
])

<div {{ $attributes->merge(['class' => 'flex border-b ui-border px-6 pt-4 ui-bg-body']) }}>
    @foreach($tabs as $tab)
        @php
            $key = $tab['key'];
            $label = $tab['label'];
            $icon = $tab['icon'] ?? null;
        @endphp
        <button
            type="button"
            @click="{{ $active }} = '{{ $key }}'"
            class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors -mb-px"
            :class="{{ $active }} === '{{ $key }}'
                ? 'ui-text border-current'
                : 'ui-text-muted border-transparent hover:ui-text hover:border-current'"
            :style="{{ $active }} === '{{ $key }}' ? 'border-color: rgb(var(--ui-primary))' : ''"
        >
            <span class="flex items-center gap-2">
                @if($icon)
                    <x-dynamic-component :component="'feathericon-' . $icon" class="w-4 h-4" />
                @endif
                {{ $label }}
            </span>
        </button>
    @endforeach
</div>
