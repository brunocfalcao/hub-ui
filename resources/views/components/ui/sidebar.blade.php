{{-- Sidebar Component --}}
{{--
    This is a reusable sidebar wrapper that provides:
    - Alpine.js accordion state management
    - localStorage persistence for open section
    - Slots for logo, navigation, and footer

    Usage:
    <x-ui::sidebar :activeSection="'servers'">
        <x-slot:logo>
            <a href="{{ route('dashboard') }}">
                <x-my-app-logo />
            </a>
        </x-slot:logo>

        {{-- Navigation goes in default slot --}}
        <x-ui::sidebar.section name="servers" label="Servers">
            <x-slot:icon>...</x-slot:icon>
            <x-ui::sidebar.link href="/servers" :active="true" child>All Servers</x-ui::sidebar.link>
        </x-ui::sidebar.section>

        <x-slot:footer>
            {{-- User avatar, logout, etc. --}}
        </x-slot:footer>
    </x-ui::sidebar>
--}}
@props([
    'activeSection' => null,
])

@php
    $persistence = config('ui-skeleton.sidebar.persistence', true);
@endphp

<div class="flex flex-col h-full items-center py-6"
     x-data="{
         open: null,
         init() {
             // Use provided active section or restore from localStorage
             const activeSection = '{{ $activeSection ?? '' }}';
             const saved = {{ $persistence ? 'localStorage.getItem(\'sidebar_open\')' : 'null' }};
             this.open = activeSection || saved || null;

             // Watch for changes and persist
             @if($persistence)
             this.$watch('open', (value) => {
                 if (value) {
                     localStorage.setItem('sidebar_open', value);
                 } else {
                     localStorage.removeItem('sidebar_open');
                 }
             });
             @endif
         }
     }">

    {{-- Logo --}}
    <div class="mb-auto">
        @if(isset($logo))
            {{ $logo }}
        @else
            @php
                $customLogo = config('ui-skeleton.app.logo');
                $dashboardRoute = config('ui-skeleton.app.dashboard_route', 'dashboard');
            @endphp
            <a href="{{ route($dashboardRoute) }}">
                @if($customLogo)
                    @include($customLogo)
                @else
                    <x-ui::sidebar.logo />
                @endif
            </a>
        @endif
    </div>

    {{-- Navigation --}}
    <nav class="flex flex-col gap-2 w-full px-2">
        {{ $slot }}
    </nav>

    {{-- Footer (avatar, logout, etc.) --}}
    @if(isset($footer))
        <div class="mt-auto">
            {{ $footer }}
        </div>
    @endif
</div>
