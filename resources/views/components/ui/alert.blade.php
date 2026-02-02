@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $colors = [
        'info' => 'text-blue-400 bg-blue-900/20 border-blue-800',
        'success' => 'text-green-400 bg-green-900/20 border-green-800',
        'warning' => 'text-yellow-400 bg-yellow-900/20 border-yellow-800',
        'error' => 'text-red-400 bg-red-900/20 border-red-800',
        'danger' => 'text-red-400 bg-red-900/20 border-red-800',
    ];

    $icons = [
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'danger' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
    ];

    $colorClass = $colors[$type] ?? $colors['info'];
    $iconPath = $icons[$type] ?? $icons['info'];
@endphp

<div
    {{ $attributes->merge(['class' => "rounded-md border p-4 {$colorClass}"]) }}
    @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
>
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {!! $iconPath !!}
            </svg>
        </div>
        <div class="ml-3 flex-1">
            @if($title)
                <h3 class="text-sm font-medium">{{ $title }}</h3>
                <div class="mt-1 text-sm opacity-90">
                    {{ $slot }}
                </div>
            @else
                <p class="text-sm">{{ $slot }}</p>
            @endif
        </div>
        @if($dismissible)
            <div class="ml-auto pl-3">
                <button @click="show = false" class="inline-flex rounded-md p-1.5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-current">
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>
