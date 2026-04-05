@props([
    'columns' => [],
    'rows' => [],
    'empty' => 'No results.',
])

<div {{ $attributes->merge(['class' => 'overflow-x-auto rounded-lg border ui-border']) }}>
    <table class="w-full text-sm text-left ui-table">
        @if(count($columns))
            <thead class="text-xs uppercase tracking-wider ui-bg-elevated">
                <tr>
                    @foreach($columns as $col)
                        <th class="px-4 py-3 font-medium whitespace-nowrap">{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            @forelse($rows as $row)
                <tr class="transition-colors">
                    @foreach($columns as $col)
                        <td class="px-4 py-2.5 whitespace-nowrap max-w-xs truncate" title="{{ $row[$col] ?? '' }}">
                            {{ $row[$col] ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) ?: 1 }}" class="px-4 py-8 text-center ui-text-subtle">
                        {{ $empty }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(count($rows))
    <p class="text-xs ui-text-subtle mt-2">{{ count($rows) }} {{ Str::plural('row', count($rows)) }}</p>
@endif
