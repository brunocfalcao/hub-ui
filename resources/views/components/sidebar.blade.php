{{-- Sidebar Component --}}
@props([
    'activeSection' => null,
    'activeHighlight' => null,
])

@php
    $persistence = config('hub-ui.sidebar.persistence', true);
    $initialHighlight = $activeHighlight ?? $activeSection ?? '';
@endphp

<div class="flex flex-col h-full items-center py-6"
     x-data="{
         open: null,
         highlight: '{{ $initialHighlight }}',
         tileTop: 0,
         tileHeight: 0,
         tileVisible: false,
         tileReady: false,
         _raf: null,
         updateTile() {
             const nav = this.$refs.nav;
             if (!nav) return;
             const target = nav.querySelector(`[data-nav-item='${this.highlight}']`);
             if (target) {
                 const navRect = nav.getBoundingClientRect();
                 const targetRect = target.getBoundingClientRect();
                 this.tileTop = targetRect.top - navRect.top;
                 this.tileHeight = targetRect.height;
                 this.tileVisible = true;
             } else {
                 this.tileVisible = false;
             }
         },
         trackTile() {
             if (this._raf) cancelAnimationFrame(this._raf);
             const start = performance.now();
             const tick = () => {
                 this.updateTile();
                 if (performance.now() - start < 400) this._raf = requestAnimationFrame(tick);
             };
             tick();
         },
         init() {
             const activeSection = '{{ $activeSection ?? '' }}';
             const saved = {{ $persistence ? 'localStorage.getItem(\'sidebar_open\')' : 'null' }};
             this.open = activeSection || saved || null;

             @if($persistence)
             this.$watch('open', (value) => {
                 if (value) {
                     localStorage.setItem('sidebar_open', value);
                 } else {
                     localStorage.removeItem('sidebar_open');
                 }
             });
             @endif

             this.$nextTick(() => {
                 // trackTile polls for ~400ms — covers x-collapse's 300ms
                 // section expand animation. A single updateTile() here
                 // races the collapse, lands the tile at 0,0 (invisible)
                 // when the active highlight lives inside a closed section
                 // that's just opening on first paint.
                 this.trackTile();
                 requestAnimationFrame(() => {
                     this.tileReady = true;
                 });
             });

             this.$watch('open', () => this.trackTile());
             this.$watch('highlight', () => this.trackTile());
         }
     }">

    {{-- Logo --}}
    <div class="mb-auto">
        @if(isset($logo))
            {{ $logo }}
        @else
            @php
                $customLogo = config('hub-ui.app.logo');
                $dashboardRoute = config('hub-ui.app.dashboard_route', 'dashboard');
            @endphp
            <a href="{{ route($dashboardRoute) }}">
                @if($customLogo)
                    @include($customLogo)
                @else
                    <x-hub-ui::sidebar.logo />
                @endif
            </a>
        @endif
    </div>

    {{-- Navigation --}}
    <nav class="flex flex-col gap-2 w-full px-2 relative" x-ref="nav">
        {{-- Sliding background tile --}}
        <div
            class="absolute inset-x-0 mx-2 rounded-xl ui-sidebar-tile pointer-events-none z-0"
            :class="tileReady ? 'transition-all duration-300 ease-in-out' : ''"
            :style="`top: ${tileTop}px; height: ${tileHeight}px; opacity: ${tileVisible ? 1 : 0}`"
        ></div>
        {{ $slot }}
    </nav>

    {{-- Footer — always-rendered spacer so the nav stays vertically
         centered regardless of whether the consumer passes a footer slot. --}}
    <div class="mt-auto">
        @isset($footer)
            {{ $footer }}
        @endisset
    </div>
</div>
