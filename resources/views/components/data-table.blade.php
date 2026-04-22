@props([
    'size' => 'md',
    'flush' => false,
])

@php
    $tableClass = 'w-full ui-table ui-data-table' . match($size) {
        'sm' => ' ui-data-table--sm',
        'lg' => ' ui-data-table--lg',
        default => '',
    };
@endphp

<div {{ $attributes->merge(['class' => 'overflow-x-auto rounded-lg border ui-border' . ($flush ? '' : ' mb-4')]) }}>
    <table class="{{ $tableClass }}">
        @if(isset($head))
            <thead class="ui-bg-elevated">
                {{ $head }}
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
        @if(isset($foot))
            <tfoot class="ui-bg-elevated">
                {{ $foot }}
            </tfoot>
        @endif
    </table>
</div>

@once
<style>
    /* Base data-table sizing */
    .ui-data-table th {
        padding: 0.625rem 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }
    .ui-data-table th.text-center { text-align: center; }
    .ui-data-table th.text-right  { text-align: right; }
    .ui-data-table td {
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        white-space: nowrap;
    }
    .ui-data-table tbody tr {
        transition: background-color 150ms;
    }
    .ui-data-table tfoot td,
    .ui-data-table tfoot th {
        padding: 0.625rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Small variant */
    .ui-data-table--sm th { padding: 0.375rem 0.75rem; }
    .ui-data-table--sm td { padding: 0.25rem 0.75rem; }
    .ui-data-table--sm tfoot td,
    .ui-data-table--sm tfoot th { padding: 0.375rem 0.75rem; }

    /* Large variant */
    .ui-data-table--lg th { padding: 0.75rem 1.25rem; font-size: 0.8125rem; }
    .ui-data-table--lg td { padding: 0.625rem 1.25rem; font-size: 0.8125rem; }
    .ui-data-table--lg tfoot td,
    .ui-data-table--lg tfoot th { padding: 0.75rem 1.25rem; font-size: 0.8125rem; }
</style>
@endonce
