{{--
    <x-hub-ui::speedometer>
    Horizontal speedometer widget with live/stale/empty states. Every prop
    accepts a JavaScript expression evaluated in the parent Alpine scope,
    so the component renders naturally inside `x-for` loops.

    Props (all strings — Alpine expressions):
        value        → number 0-100, percentage to render (required)
        label        → string, small header label (required)
        stale        → bool, renders last reading in a muted dark gray
                       (default: false)
        empty        → bool, hides the reading and shows "no data"
                       (default: false)
        leftDetail   → string, tiny bottom-left subtext (default: "")
        rightDetail  → string, tiny bottom-right subtext (default: "")
--}}
@props([
    'value',
    'label',
    'stale' => 'false',
    'empty' => 'false',
    'leftDetail' => "''",
    'rightDetail' => "''",
])

<div
    x-data="{
        speedometerColor(v, stale) {
            if (stale) return '#374151';
            if (v >= 70) return 'rgb(var(--ui-success))';
            if (v >= 30) return 'rgb(var(--ui-warning))';
            return 'rgb(var(--ui-danger))';
        }
    }"
    {{ $attributes->merge(['class' => 'ui-bg-elevated rounded-lg p-3']) }}
>
    <div class="flex items-baseline justify-between mb-2">
        <span class="text-xs font-semibold ui-text" x-text="{!! $label !!}"></span>
        <span
            class="text-[11px] font-mono ui-tabular"
            :class="({!! $empty !!}) ? 'ui-text-subtle' : ''"
            x-text="({!! $empty !!}) ? 'no data' : ((({!! $value !!}) ?? 0).toFixed(1) + '%')"
            :style="({!! $empty !!}) ? '' : ('color: ' + speedometerColor(({!! $value !!}) ?? 0, {!! $stale !!}))"
        ></span>
    </div>

    <div class="relative w-full h-2 rounded-full overflow-hidden ui-bg">
        <div
            class="absolute inset-y-0 left-0 rounded-full"
            :style="'width:' + (({!! $empty !!}) ? 0 : (({!! $value !!}) ?? 0)) + '%; background-color:' + speedometerColor(({!! $value !!}) ?? 0, {!! $stale !!}) + '; transition: width 0.6s ease;'"
        ></div>
    </div>

    <div class="flex items-center justify-between mt-2 text-[10px] ui-text-subtle font-mono">
        <span x-text="{!! $leftDetail !!}"></span>
        <span x-text="{!! $rightDetail !!}"></span>
    </div>
</div>
