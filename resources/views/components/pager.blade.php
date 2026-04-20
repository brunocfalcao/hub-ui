@props([
    'page' => 'page',
    'lastPage' => 'lastPage',
    'perPage' => 'perPage',
    'total' => 'total',
    'visiblePages' => 'visiblePages',
    'goTo' => 'goToPage',
    'duration' => null,
    'perPageOptions' => [10, 25, 50, 100],
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between pt-1']) }}>
    <div class="flex items-center gap-3">
        <span
            class="text-xs ui-text-subtle"
            x-text="'Showing ' + (({{ $page }} - 1) * {{ $perPage }} + 1) + '-' + Math.min({{ $page }} * {{ $perPage }}, {{ $total }}) + ' of ' + {{ $total }} + ' rows'"
        ></span>
        @if($duration)
            <span class="text-xs ui-text-subtle" x-text="{{ $duration }} + 'ms'"></span>
        @endif
    </div>

    <div class="flex items-center gap-1">
        {{-- First --}}
        <button
            type="button"
            @click="{{ $goTo }}(1)"
            :disabled="{{ $page }} === 1"
            class="p-1.5 rounded transition-colors"
            :class="{{ $page }} === 1 ? 'ui-text-subtle cursor-not-allowed' : 'ui-text-muted hover:ui-text'"
        >
            <x-feathericon-chevrons-left class="w-4 h-4" />
        </button>

        {{-- Previous --}}
        <button
            type="button"
            @click="{{ $goTo }}({{ $page }} - 1)"
            :disabled="{{ $page }} === 1"
            class="p-1.5 rounded transition-colors"
            :class="{{ $page }} === 1 ? 'ui-text-subtle cursor-not-allowed' : 'ui-text-muted hover:ui-text'"
        >
            <x-feathericon-chevron-left class="w-4 h-4" />
        </button>

        {{-- Page numbers --}}
        <template x-for="p in {{ $visiblePages }}" :key="'pg'+p">
            <button
                type="button"
                @click="{{ $goTo }}(p)"
                class="min-w-[28px] h-7 px-1.5 text-xs rounded transition-colors"
                :class="p === {{ $page }} ? 'ui-bg-primary text-white font-medium' : (p === '...' ? 'ui-text-subtle cursor-default' : 'ui-text-muted hover:ui-text hover:ui-bg-elevated')"
                x-text="p"
            ></button>
        </template>

        {{-- Next --}}
        <button
            type="button"
            @click="{{ $goTo }}({{ $page }} + 1)"
            :disabled="{{ $page }} === {{ $lastPage }}"
            class="p-1.5 rounded transition-colors"
            :class="{{ $page }} === {{ $lastPage }} ? 'ui-text-subtle cursor-not-allowed' : 'ui-text-muted hover:ui-text'"
        >
            <x-feathericon-chevron-right class="w-4 h-4" />
        </button>

        {{-- Last --}}
        <button
            type="button"
            @click="{{ $goTo }}({{ $lastPage }})"
            :disabled="{{ $page }} === {{ $lastPage }}"
            class="p-1.5 rounded transition-colors"
            :class="{{ $page }} === {{ $lastPage }} ? 'ui-text-subtle cursor-not-allowed' : 'ui-text-muted hover:ui-text'"
        >
            <x-feathericon-chevrons-right class="w-4 h-4" />
        </button>

        {{-- Per page --}}
        <div class="ml-3 flex items-center gap-2 pl-3 border-l ui-border">
            <select
                x-model.number="{{ $perPage }}"
                @change="{{ $goTo }}(1)"
                class="text-xs py-1 pl-2 pr-6 rounded border ui-input"
                style="min-width: 4rem;"
            >
                @foreach($perPageOptions as $opt)
                    <option value="{{ $opt }}">{{ $opt }}</option>
                @endforeach
            </select>
            <span class="text-xs ui-text-subtle">per page</span>
        </div>
    </div>
</div>
