@props([
    'value',
    'format' => 'int',
    'decimals' => 0,
])

@php
    $formatExpr = match($format) {
        'float' => 'shown.toFixed(' . (int) $decimals . ')',
        'int'   => 'Math.round(shown).toLocaleString()',
        'raw'   => 'shown',
        default => 'Math.round(shown).toLocaleString()',
    };
@endphp

<span
    x-data="hubUiCounter()"
    x-effect="target = Number({{ $value }}) || 0"
    x-text="{{ $formatExpr }}"
    style="font-variant-numeric: tabular-nums;"
    {{ $attributes }}
></span>
