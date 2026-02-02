{{-- Status Indicator Component --}}
{{-- Usage: <x-ui::status color="emerald" label="Connected" /> --}}
{{-- With tooltip: <x-ui::status color="red" label="Error" title="Connection failed" /> --}}
{{-- Animated: <x-ui::status color="blue" label="Processing" :animated="true" /> --}}
{{--
    NOTE: This component uses dynamic Tailwind classes (bg-{color}-500, text-{color}-400).
    You must safelist these colors in your tailwind.config.js:

    safelist: [
        { pattern: /^(bg|text)-(red|green|blue|yellow|gray|emerald|amber)-(300|400|500)$/ },
    ]
--}}
@props([
    'color' => 'gray',
    'label',
    'animated' => false,
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    @if($animated)
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-{{ $color }}-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-{{ $color }}-500"></span>
        </span>
    @else
        <span class="w-2 h-2 rounded-full bg-{{ $color }}-500"></span>
    @endif
    <span class="text-sm text-{{ $color }}-400">{{ $label }}</span>
</div>
