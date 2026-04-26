@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'hint' => null,
    'error' => null,
    'notice' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'rows' => 3,
])

@php
    $inputId = $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);
    $inputClasses = 'block w-full px-4 py-2.5 text-sm border rounded-lg ui-input';

    if ($hasError) {
        $inputClasses .= ' ui-input-error';
    }
    if ($disabled) {
        $inputClasses .= ' opacity-50 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'space-y-1']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium ui-label">
            {{ $label }}
            @if($required)
                <span class="ui-required">*</span>
            @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
    >{{ old($name, $value) }}</textarea>

    @if($hint && !$hasError && !$notice)
        <p class="text-sm ui-hint">{{ $hint }}</p>
    @endif

    @if($notice && !$hasError)
        <p class="text-sm ui-text-info">{{ $notice }}</p>
    @endif

    @if($hasError)
        <p class="text-sm ui-error">{{ $errorMessage }}</p>
    @endif
</div>
