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
    $inputClasses = 'block w-full pl-4 pr-10 py-2.5 text-sm border rounded-lg cursor-pointer ui-input ui-select';

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
        <p class="text-[11px] ui-hint leading-snug flex items-start gap-1">
            <svg class="w-3 h-3 mt-0.5 flex-shrink-0 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4M12 8h.01" />
            </svg>
            <span>{{ $hint }}</span>
        </p>
    @endif

    @if($notice && !$hasError)
        <p class="text-[11px] ui-text-info leading-snug flex items-start gap-1">
            <svg class="w-3 h-3 mt-0.5 flex-shrink-0 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4M12 8h.01" />
            </svg>
            <span>{{ $notice }}</span>
        </p>
    @endif

    @if($hasError)
        <p class="text-[11px] ui-error leading-snug flex items-start gap-1">
            <svg class="w-3 h-3 mt-0.5 flex-shrink-0 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
            </svg>
            <span>{{ $errorMessage }}</span>
        </p>
    @endif
</div>
