{{-- Dashboard Layout with Sidebar --}}
@props([
    'title' => config('app.name'),
    'flush' => false,
])

@php
    $sidebarWidth = config('hub-ui.sidebar.width', 'w-28');
    $toastEnabled = config('hub-ui.features.toast', true);
    $confirmationEnabled = config('hub-ui.features.confirmation', true);
    $navigateFade = config('hub-ui.features.navigate_fade', true);
    $fonts = config('hub-ui.layout.fonts', []);
    $bodyFont = $fonts['body'] ?? 'Inter';
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    {{-- Theme script (synchronous — prevents FOUC) --}}
    @include('hub-ui::partials.scripts')

    {{-- Theme CSS variables and utilities --}}
    @include('hub-ui::partials.styles')

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{ $head ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(class_exists(\Livewire\Livewire::class))
        @livewireStyles
    @endif
</head>
<body class="ui-text antialiased" style="font-family: '{{ $bodyFont }}', sans-serif; background-color: rgb(var(--ui-bg-body))">
    <div id="app-shell" class="flex h-screen overflow-hidden"
         x-data="{ sidebarOpen: false }">

        {{-- Mobile Menu Button --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="fixed top-1/2 -translate-y-1/2 left-0 z-50 lg:hidden inline-flex items-center justify-center h-10 w-8 rounded-r-lg border border-l-0 transition-colors"
            style="background-color: rgb(var(--ui-bg-elevated)); border-color: rgb(var(--ui-border)); color: rgb(var(--ui-text-muted))"
        >
            <svg x-show="!sidebarOpen" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="sidebarOpen" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Mobile Overlay --}}
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"
            x-cloak
        ></div>

        {{-- Sidebar --}}
        @persist('sidebar')
        <aside
            class="fixed lg:static inset-y-0 left-0 z-40 {{ $sidebarWidth }} h-screen lg:h-full flex-shrink-0 transform transition-transform duration-300 ease-in-out lg:translate-x-0 border-r ui-border"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            style="background-color: rgb(var(--ui-bg-sidebar))"
        >
            {{ $sidebar ?? '' }}
        </aside>
        @endpersist

        {{-- Main content --}}
        <main class="flex-1 flex flex-col overflow-hidden">
            <div class="flex-1 {{ $flush ? 'overflow-hidden' : 'overflow-y-auto px-12 py-12' }} {{ $navigateFade ? 'navigate-fade' : '' }}">
                {{ $slot }}
            </div>
        </main>
    </div>

    @if($toastEnabled)
        <x-hub-ui::toast />
    @endif

    @if($confirmationEnabled)
        <x-hub-ui::modal-confirmation />
    @endif

    {{ $scripts ?? '' }}

    @if(class_exists(\Livewire\Livewire::class))
        @livewireScriptConfig
    @endif
</body>
</html>
