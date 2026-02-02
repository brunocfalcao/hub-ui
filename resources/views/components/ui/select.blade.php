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

    $inputClasses = 'block w-full border rounded-md shadow-sm text-neutral-100 focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 transition';

    if ($hasError) {
        $inputClasses .= ' border-red-500 bg-red-900/10 focus:border-red-500 focus:ring-red-500';
    } else {
        $inputClasses .= ' border-neutral-700 bg-neutral-800 focus:border-emerald-500 focus:ring-emerald-500';
    }

    if ($disabled) {
        $inputClasses .= ' opacity-50 cursor-not-allowed';
    }
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'space-y-1']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-neutral-300">
            {{ $label }}
            @if($required)
                <span class="text-emerald-400">*</span>
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
        @if($placeholder)
            <option value="" class="bg-neutral-800">{{ $placeholder }}</option>
        @endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected($selectedValue == $optionValue) class="bg-neutral-800">
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if($hint && !$hasError && !$notice)
        <p class="text-sm text-neutral-500">{{ $hint }}</p>
    @endif

    @if($notice && !$hasError)
        <p class="text-sm text-blue-400">{{ $notice }}</p>
    @endif

    @if($hasError)
        <p class="text-sm text-red-400">{{ $errorMessage }}</p>
    @endif
</div>
