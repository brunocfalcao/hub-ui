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
            class="rounded border-neutral-700 bg-neutral-800 text-emerald-600 shadow-sm focus:ring-emerald-500 focus:ring-offset-neutral-900 @if($disabled) opacity-50 cursor-not-allowed @endif"
        >
        @if($label)
            <span class="ms-2 text-sm text-neutral-300">{{ $label }}</span>
        @endif
    </label>

    @if($hint && !$hasError)
        <p class="text-sm text-neutral-500 ms-6">{{ $hint }}</p>
    @endif

    @if($hasError)
        <p class="text-sm text-red-400 ms-6">{{ $errorMessage }}</p>
    @endif
</div>
