{{-- Sidebar Section (Accordion Parent with collapsible children) --}}
@props([
    'name' => '',
    'label' => '',
    'icon' => null,
])

<div class="relative z-10">
    {{-- Parent button (toggles accordion) --}}
    <button
        type="button"
        @click="
            open = open === '{{ $name }}' ? null : '{{ $name }}';
            highlight = '{{ $name }}';
        "
        data-nav-item="{{ $name }}"
        class="w-full flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors relative"
        :class="open === '{{ $name }}' ? 'text-white' : 'text-white/40 hover:text-white/60'"
    >
        @if($icon)
            <span class="w-7 h-7">
                {{ $icon }}
            </span>
        @endif
        <span class="text-xs">{{ $label }}</span>
    </button>

    {{-- Child items (accordion content) --}}
    <div x-show="open === '{{ $name }}'" x-collapse.duration.300ms class="flex flex-col gap-1 mt-1">
        {{ $slot }}
    </div>
</div>
