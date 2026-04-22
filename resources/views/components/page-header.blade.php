{{-- Page Header Component --}}
@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6 sm:mb-8']) }}>
    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-medium ui-text leading-tight">{{ $title }}</h1>
    @if($description)
        <p class="text-sm ui-text-subtle mt-2">{{ $description }}</p>
    @endif
</div>
