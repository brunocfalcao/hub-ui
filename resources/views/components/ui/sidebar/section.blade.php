{{-- Sidebar Section (Accordion Parent with collapsible children) --}}
@props([
    'name' => '',
    'label' => '',
    'icon' => null,
])

<div>
    {{-- Parent button (toggles accordion) - highlighted when this section is open --}}
    <button
        type="button"
        @click="open = open === '{{ $name }}' ? null : '{{ $name }}'"
        class="w-full flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors"
        :class="open === '{{ $name }}' ? 'text-white bg-white/5' : 'text-white/40 hover:text-white/60 hover:bg-white/5'"
    >
        @if($icon)
            <span class="w-7 h-7">
                {{ $icon }}
            </span>
        @endif
        <span class="text-xs">{{ $label }}</span>
    </button>

    {{-- Child items (accordion content) --}}
    <div x-show="open === '{{ $name }}'" x-collapse class="flex flex-col gap-1 mt-1">
        {{ $slot }}
    </div>
</div>
