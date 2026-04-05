{{-- Status Indicator Component --}}
{{-- Usage: <x-hub-ui::status type="success" label="Connected" /> --}}
{{-- Animated: <x-hub-ui::status type="info" label="Processing" :animated="true" /> --}}
@props([
    'type' => 'default',
    'label',
    'animated' => false,
])

@php
    $colorVar = match($type) {
        'primary' => '--ui-primary',
        'success' => '--ui-success',
        'warning' => '--ui-warning',
        'danger' => '--ui-danger',
        'info' => '--ui-info',
        'secondary' => '--ui-secondary',
        default => '--ui-text-subtle',
    };
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }} style="--status-color: rgb(var({{ $colorVar }}))">
    @if($animated)
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 ui-status-dot"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 ui-status-dot"></span>
        </span>
    @else
        <span class="w-2 h-2 rounded-full ui-status-dot"></span>
    @endif
    <span class="text-sm ui-status-text">{{ $label }}</span>
</div>
