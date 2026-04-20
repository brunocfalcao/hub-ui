@props([
    'value',
    'suffix' => '%',
    'precision' => 1,
    'showZero' => false,
])

<span
    x-data="{
        get delta() { return Number({{ $value }}) || 0; },
        get trendClass() {
            if (this.delta > 0) return 'ui-text-success';
            if (this.delta < 0) return 'ui-text-danger';
            return 'ui-text-subtle';
        },
        get formatted() {
            const v = this.delta;
            const abs = Math.abs(v).toFixed({{ (int) $precision }});
            if (v > 0) return '▲ ' + abs + '{{ $suffix }}';
            if (v < 0) return '▼ ' + abs + '{{ $suffix }}';
            return '— {{ $suffix }}';
        },
    }"
    x-show="{{ $showZero ? 'true' : 'delta !== 0' }}"
    :class="trendClass"
    class="inline-flex items-center text-[10px] font-medium"
    style="font-variant-numeric: tabular-nums;"
    x-text="formatted"
    {{ $attributes }}
></span>
