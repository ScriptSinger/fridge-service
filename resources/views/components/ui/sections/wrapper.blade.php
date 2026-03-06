@props([
    'innerClass' => 'container mx-auto px-5 py-10 md:py-24',
])

<section {{ $attributes->merge(['class' => 'body-font text-gray-600']) }}>
    <div class="{{ $innerClass }}">
        {{ $slot }}
    </div>
</section>
