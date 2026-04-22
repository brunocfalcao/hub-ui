{{--
    Switch / Toggle

    Usage:
      1. With x-model:
         <x-hub-ui::switch x-model="enabled" label="Enable feature" />

      2. Controlled (handle click yourself):
         <x-hub-ui::switch state="isActive" @click="handleToggle()" />

      3. Sizes: sm | md (default) | lg
      4. Colors: primary (default) | success | warning | danger | info
      5. Label position: left (default) | right
--}}

@props([
    'label' => null,
    'labelPosition' => 'left',
    'on' => null,
    'disabled' => false,
    'size' => 'md',
    'onColor' => 'primary',
])

@php
    $dims = match($size) {
        'sm' => ['track_w' => 28, 'track_h' => 16, 'thumb' => 12, 'pad' => 2],
        'lg' => ['track_w' => 44, 'track_h' => 24, 'thumb' => 18, 'pad' => 3],
        default => ['track_w' => 36, 'track_h' => 20, 'thumb' => 14, 'pad' => 3],
    };

    $offLeft = "{$dims['pad']}px";
    $onLeft = ($dims['track_w'] - $dims['thumb'] - $dims['pad']) . 'px';

    $colorVar = match($onColor) {
        'success' => '--ui-success',
        'warning' => '--ui-warning',
        'danger' => '--ui-danger',
        'info' => '--ui-info',
        default => '--ui-primary',
    };

    $xModel = $attributes->get('x-model');
    $stateAttr = $attributes->get('state');

    if ($xModel) {
        $stateExpr = $xModel;
        $clickHandler = "{$xModel} = !{$xModel}";
    } elseif ($stateAttr) {
        $stateExpr = $stateAttr;
        $clickHandler = null;
    } elseif ($on !== null) {
        $stateExpr = $on ? 'true' : 'false';
        $clickHandler = null;
    } else {
        $stateExpr = '__switchOn';
        $clickHandler = '__switchOn = !__switchOn';
    }
@endphp

<label
    {{ $attributes->except(['x-model', 'state'])->merge(['class' => 'inline-flex items-center gap-2 align-middle' . ($disabled ? ' opacity-50 cursor-not-allowed' : ' cursor-pointer')]) }}
    @if(!$xModel && !$stateAttr && $on === null) x-data="{ __switchOn: false }" @endif
>
    @if($label && $labelPosition === 'left')
        <span class="text-sm ui-text-muted">{{ $label }}</span>
    @endif

    <button
        type="button"
        role="switch"
        @if($disabled) disabled @endif
        :aria-checked="{{ $stateExpr }}"
        class="relative inline-block rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-1"
        style="width: {{ $dims['track_w'] }}px; height: {{ $dims['track_h'] }}px; background-color: rgb(var(--ui-border));"
        :style="{ backgroundColor: {{ $stateExpr }} ? 'rgb(var({{ $colorVar }}))' : 'rgb(var(--ui-border))' }"
        @if($clickHandler && !$disabled) @click="{{ $clickHandler }}" @endif
    >
        <span
            aria-hidden="true"
            class="absolute top-1/2 rounded-full bg-white shadow-sm transition-all duration-200 ease-in-out"
            style="width: {{ $dims['thumb'] }}px; height: {{ $dims['thumb'] }}px; left: {{ $offLeft }}; transform: translateY(-50%);"
            :style="{ left: {{ $stateExpr }} ? '{{ $onLeft }}' : '{{ $offLeft }}' }"
        ></span>
    </button>

    @if($label && $labelPosition === 'right')
        <span class="text-sm ui-text-muted">{{ $label }}</span>
    @endif
</label>
