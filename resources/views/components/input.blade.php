@props([
    'name',
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
    $inputId = $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);

    $inputClasses = 'block w-full border rounded-md shadow-sm text-neutral-100 placeholder-neutral-500 focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 transition';

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
        <p class="text-sm text-neutral-500">{{ $hint }}</p>
    @endif

    @if($notice && !$hasError)
        <p class="text-sm text-blue-400">{{ $notice }}</p>
    @endif

    @if($hasError)
        <p class="text-sm text-red-400">{{ $errorMessage }}</p>
    @endif
</div>
