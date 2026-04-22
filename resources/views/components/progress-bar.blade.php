{{--
    <x-hub-ui::progress-bar>
    Segmented progress bar. Given a percentage value (0-100) and a tick
    count, fills the corresponding number of left-to-right tick bars. 20%
    over 5 ticks = 1 tick; 45% over 10 ticks = 5 ticks (Math.round).

    Every reactive prop accepts a JavaScript expression evaluated in the
    parent Alpine scope, so the component works naturally inside x-for.

    Props (Alpine expressions unless noted):
        value         → number 0-100 (required)
        ticks         → int, blade-side (default: 10)
        stale         → bool, renders last reading in a dark muted color
                        (default: false)
        empty         → bool, shows all empty ticks (default: false)
        tickWidth     → px, blade-side (default: 6)
        tickHeight    → px, blade-side (default: 18)
        tickGap       → px, blade-side (default: 2)
--}}
@props([
    'value',
    'ticks' => 10,
    'stale' => 'false',
    'empty' => 'false',
    'tickWidth' => 6,
    'tickHeight' => 18,
    'tickGap' => 2,
])

<div
    x-data="{
        progressBarColor(v, stale) {
            if (stale) return '#374151';
            if (v >= 70) return 'rgb(var(--ui-success))';
            if (v >= 30) return 'rgb(var(--ui-warning))';
            return 'rgb(var(--ui-danger))';
        },
    }"
    {{ $attributes->merge(['class' => 'inline-flex items-center flex-nowrap']) }}
    style="gap: {{ $tickGap }}px; height: {{ $tickHeight }}px;"
>
    <template x-for="__i in {{ (int) $ticks }}" :key="'pb-' + __i">
        <span
            class="inline-block rounded-sm transition-colors duration-300"
            style="width: {{ $tickWidth }}px; height: 100%; background-color: rgb(var(--ui-border));"
            :style="{
                backgroundColor: ({!! $empty !!})
                    ? 'rgb(var(--ui-border))'
                    : (__i <= Math.round((({!! $value !!}) ?? 0) / 100 * {{ (int) $ticks }})
                        ? progressBarColor(({!! $value !!}) ?? 0, {!! $stale !!})
                        : 'rgb(var(--ui-border))')
            }"
        ></span>
    </template>
</div>
