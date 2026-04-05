@props([
    'name',
    'label' => null,
    'value' => '1',
    'checked' => false,
    'hint' => null,
    'error' => null,
    'disabled' => false,
])

@php
    $inputId = $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);
    $isChecked = old($name) !== null ? old($name) == $value : $checked;
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'space-y-1']) }}>
    <label for="{{ $inputId }}" class="inline-flex items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ $value }}"
            @checked($isChecked)
            @if($disabled) disabled @endif
            class="rounded shadow-sm focus:ring-offset-2 ui-checkbox @if($disabled) opacity-50 cursor-not-allowed @endif"
        >
        @if($label)
            <span class="ms-2 text-sm ui-label">{{ $label }}</span>
        @endif
    </label>

    @if($hint && !$hasError)
        <p class="text-sm ui-hint ms-6">{{ $hint }}</p>
    @endif

    @if($hasError)
        <p class="text-sm ui-error ms-6">{{ $errorMessage }}</p>
    @endif
</div>
