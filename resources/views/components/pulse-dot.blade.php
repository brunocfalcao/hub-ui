{{--
    Pulse Dot

    A status dot with an optional animated "ping" ring. Use when you need a
    plain indicator without a label (for labeled usage, use <x-hub-ui::status>).

    Usage:
      <x-hub-ui::pulse-dot type="success" />
      <x-hub-ui::pulse-dot type="warning" :pulse="true" size="md" />
      <x-hub-ui::pulse-dot :pulse="$active" type="warning" />
--}}

@props([
    'type' => 'default',
    'pulse' => false,
    'size' => 'sm',
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

    $sizePx = match($size) {
        'xs' => 6,
        'sm' => 8,
        'md' => 10,
        'lg' => 12,
        default => 8,
    };
@endphp

<span
    {{ $attributes->merge(['class' => 'relative inline-block flex-shrink-0']) }}
    style="width: {{ $sizePx }}px; height: {{ $sizePx }}px;"
>
    @if($pulse)
        <span
            class="absolute inset-0 rounded-full animate-ping opacity-75"
            style="background-color: rgb(var({{ $colorVar }}))"
        ></span>
    @endif
    <span
        class="absolute inset-0 rounded-full"
        style="background-color: rgb(var({{ $colorVar }}))"
    ></span>
</span>
