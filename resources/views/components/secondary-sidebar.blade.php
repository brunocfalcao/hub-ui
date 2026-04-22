@props([
    'widthModel' => 'sidebarWidth',
    'resizeFn' => 'startSidebarResize',
])

<div
    x-data="{
        secondaryOpen: false,
        isDesktop: window.matchMedia('(min-width: 1024px)').matches,
        init() {
            const mq = window.matchMedia('(min-width: 1024px)');
            const handler = () => { this.isDesktop = mq.matches; if (mq.matches) this.secondaryOpen = false; };
            mq.addEventListener('change', handler);
        }
    }"
    class="contents"
>
    {{-- Mobile toggle --}}
    <button
        type="button"
        @click="secondaryOpen = !secondaryOpen"
        :aria-label="secondaryOpen ? 'Close panel' : 'Open panel'"
        :aria-expanded="secondaryOpen"
        class="fixed top-3 right-3 z-40 lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-lg border transition-colors shadow-sm"
        style="background-color: rgb(var(--ui-bg-elevated)); border-color: rgb(var(--ui-border)); color: rgb(var(--ui-text-muted))"
    >
        <svg x-show="!secondaryOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
        </svg>
        <svg x-show="secondaryOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Mobile overlay --}}
    <div
        x-show="secondaryOpen"
        x-cloak
        @click="secondaryOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 z-30 lg:hidden"
    ></div>

    {{-- Sidebar pane: fixed drawer on mobile, static pane on lg+ --}}
    <div
        @click="if (!isDesktop && $event.target.closest('button, a[href]')) secondaryOpen = false"
        class="hub-ui-secondary-aside fixed inset-y-0 right-0 z-40 w-[85vw] max-w-sm lg:static lg:w-auto lg:max-w-none lg:flex-shrink-0 border-l lg:border-l-0 lg:border-r ui-border overflow-hidden flex flex-col ui-bg-sidebar"
        :class="secondaryOpen && 'is-open'"
        :style="isDesktop ? ('width:' + {{ $widthModel }} + 'px') : ''"
    >
        {{ $slot }}
    </div>

    {{-- Resize Handle (desktop only) --}}
    <div
        class="hidden lg:block w-1 flex-shrink-0 cursor-col-resize relative transition-colors hub-ui-resize-handle"
        @mousedown.prevent="{{ $resizeFn }}($event)"
    >
        <div class="absolute inset-y-0 -left-1 -right-1"></div>
    </div>
</div>

@once
    <style>
        .hub-ui-resize-handle:hover {
            background-color: rgb(var(--ui-primary) / 0.3);
        }
    </style>
@endonce
