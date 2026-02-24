@props([
    'title' => null,
    'subtitle' => null,
])

<div class="flex flex-col w-full mb-12 text-center md:text-left">
    @if ($title)
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-medium title-font mb-4 text-gray-900">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="lg:w-2/3 leading-relaxed text-base">{{ $subtitle }}</p>
    @endif
</div>
