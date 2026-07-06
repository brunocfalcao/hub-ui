{{-- Page Header Component --}}
@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <div class="flex items-end justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-3">
            @isset($icon)
                {{ $icon }}
            @endisset
            <div>
                <h1 class="text-2xl font-semibold ui-text leading-tight">{{ $title }}</h1>
                @if($description)
                    <p class="text-sm ui-text-subtle mt-1">{{ $description }}</p>
                @endif
            </div>
        </div>
        @isset($actions)
            <div class="flex items-center gap-3">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
