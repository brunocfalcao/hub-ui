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
