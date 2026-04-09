@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'hint' => null,
    'error' => null,
    'notice' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => null,
    'autofocus' => false,
])

@php
    $inputId = $id ?? $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);
    $inputClasses = 'block w-full px-4 py-3 text-sm border rounded-lg shadow-sm focus:ring-2 focus:ring-offset-2 transition ui-input';

    if ($hasError) {
        $inputClasses .= ' ui-input-error';
    }
    if ($disabled) {
        $inputClasses .= ' opacity-50 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'space-y-2']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium ui-label">
            {{ $label }}
            @if($required)
                <span class="ui-required">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        @if($autofocus) autofocus @endif
        {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
    >

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
