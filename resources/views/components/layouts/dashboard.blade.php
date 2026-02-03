{{-- Dashboard Layout with Sidebar --}}
{{--
    Usage:
    <x-hub-ui::layouts.dashboard title="Page Title">
        <x-slot:sidebar>
            <x-hub-ui::sidebar :activeSection="'servers'">
                ...navigation...
            </x-hub-ui::sidebar>
        </x-slot:sidebar>

        <!-- Main content -->
        <x-hub-ui::page-header title="Servers" />
        ...

        <x-slot:scripts>
            <!-- Page-specific scripts -->
        </x-slot:scripts>
    </x-hub-ui::layouts.dashboard>
--}}
@props([
    'title' => config('app.name'),
])

@php
    $bodyBg = config('hub-ui.layout.colors.body', '#1a1e2e');
    $sidebarBg = config('hub-ui.layout.colors.sidebar', '#151820');
    $sidebarWidth = config('hub-ui.sidebar.width', 'w-28');
    $toastEnabled = config('hub-ui.features.toast', true);
    $confirmationEnabled = config('hub-ui.features.confirmation', true);
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Head slot for additional styles/meta --}}
    {{ $head ?? '' }}

    {{-- Vite assets - consumer must configure --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-neutral-100 antialiased" style="font-family: 'Inter', sans-serif; background-color: {{ $bodyBg }}">
    {{-- Main container: flex row --}}
    <div id="app-shell" class="flex h-screen overflow-hidden"
         x-data="{ sidebarOpen: false }">

        {{-- Mobile Menu Button --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="fixed top-1/2 -translate-y-1/2 left-0 z-50 lg:hidden inline-flex items-center justify-center h-10 w-8 rounded-r-lg bg-white/5 border border-white/10 border-l-0 text-white/70 hover:bg-white/10 hover:text-white transition-colors"
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

        {{-- Sidebar (left, fixed width) --}}
        <aside
            class="fixed lg:static inset-y-0 left-0 z-40 {{ $sidebarWidth }} flex-shrink-0 transform transition-transform duration-300 ease-in-out lg:translate-x-0 border-r border-white/5"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            style="background-color: {{ $sidebarBg }}"
        >
            {{ $sidebar ?? '' }}
        </aside>

        {{-- Main content (right, flexible) --}}
        <main class="flex-1 flex flex-col overflow-hidden">
            {{-- Main scrollable content --}}
            <div class="flex-1 overflow-y-auto px-12 py-12">
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- Toast Notifications --}}
    @if($toastEnabled)
        <x-hub-ui::toast />
    @endif

    {{-- Confirmation Modal --}}
    @if($confirmationEnabled)
        <x-hub-ui::modal-confirmation />
    @endif

    {{-- Scripts slot --}}
    {{ $scripts ?? '' }}
</body>
</html>
