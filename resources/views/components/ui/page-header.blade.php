{{-- Page Header Component --}}
@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    <h1 class="text-5xl font-medium text-white">{{ $title }}</h1>
    @if($description)
        <p class="text-sm text-white/40 mt-2">{{ $description }}</p>
    @endif
</div>
