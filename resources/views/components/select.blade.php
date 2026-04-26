@props([
    'name',
    'label' => null,
    'value' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'hint' => null,
    'error' => null,
    'notice' => null,
    'required' => false,
    'disabled' => false,
])

@php
    $inputId = $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);
    $selectedValue = old($name, $value);
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

    <select
        name="{{ $name }}"
        id="{{ $inputId }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
    >
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            @if($placeholder)
                <option value="" class="ui-bg-input">{{ $placeholder }}</option>
            @endif
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected($selectedValue == $optionValue) class="ui-bg-input">
                    {{ $optionLabel }}
                </option>
            @endforeach
        @endif
    </select>

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
