{{--
    Switch/Toggle Component

    Usage:
    1. With x-model (auto-toggles on click):
       <div x-data="{ enabled: false }">
           <x-hub-ui::switch x-model="enabled" label="Enable feature" />
       </div>

    2. Controlled mode (display only, handle click yourself):
       <x-hub-ui::switch state="isActive" @click="handleToggle()" label="Status" />

    3. With custom colors: primary (default), success, warning, danger, info
       <x-hub-ui::switch x-model="active" onColor="warning" />

    4. Sizes: sm, md (default), lg
       <x-hub-ui::switch x-model="on" size="sm" />

    5. Label position: left (default), right
       <x-hub-ui::switch x-model="on" label="Enable" labelPosition="right" />
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
    $sizeClasses = match($size) {
        'sm' => ['track' => 'h-4 w-7', 'thumb' => 'h-3 w-3', 'translatePx' => '12px'],
        'lg' => ['track' => 'h-6 w-11', 'thumb' => 'h-5 w-5', 'translatePx' => '20px'],
        default => ['track' => 'h-5 w-9', 'thumb' => 'h-4 w-4', 'translatePx' => '16px'],
    };

    $colorVar = match($onColor) {
        'success' => '--ui-success',
        'warning' => '--ui-warning',
        'danger' => '--ui-danger',
        'info' => '--ui-info',
        default => '--ui-primary',
    };

    // Determine the mode:
    // 1. x-model="var" - auto-toggles on click, binds to parent Alpine state
    // 2. state="expression" - controlled mode, displays state but doesn't auto-toggle
    // 3. Neither - standalone with internal __switchOn state
    $xModel = $attributes->get('x-model');
    $stateAttr = $attributes->get('state');

    if ($xModel) {
        $stateExpr = $xModel;
        $clickHandler = "{$xModel} = !{$xModel}";
    } elseif ($stateAttr) {
        // Controlled mode: use the state expression
        $stateExpr = $stateAttr;
        $clickHandler = null; // No auto-toggle in controlled mode
    } elseif ($on !== null) {
        // Static boolean passed
        $stateExpr = $on ? 'true' : 'false';
        $clickHandler = null;
    } else {
        // Standalone with internal state
        $stateExpr = '__switchOn';
        $clickHandler = '__switchOn = !__switchOn';
    }
@endphp

<label
    {{ $attributes->except(['x-model', 'state'])->merge(['class' => 'inline-flex items-center gap-2' . ($disabled ? ' opacity-50 cursor-not-allowed' : ' cursor-pointer')]) }}
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
        class="relative inline-flex {{ $sizeClasses['track'] }} flex-shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
        :class="{{ $stateExpr }} ? '' : 'ui-bg-input'"
        :style="{{ $stateExpr }} ? 'background-color: rgb(var({{ $colorVar }}))' : ''"
        @if($clickHandler && !$disabled) @click="{{ $clickHandler }}" @endif
    >
        <span
            aria-hidden="true"
            class="pointer-events-none inline-block {{ $sizeClasses['thumb'] }} rounded-full bg-white shadow ring-0 transition-transform duration-200 ease-in-out"
            :style="{{ $stateExpr }} ? 'transform: translateX({{ $sizeClasses['translatePx'] }})' : 'transform: translateX(0)'"
        ></span>
    </button>

    @if($label && $labelPosition === 'right')
        <span class="text-sm ui-text-muted">{{ $label }}</span>
    @endif
</label>
