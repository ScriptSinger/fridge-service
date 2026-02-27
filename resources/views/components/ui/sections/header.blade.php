@props([
    'title' => null,
    'subtitle' => null,
    'suptitle' => null,
])

<div class="flex flex-col w-full mb-12 text-center md:text-left">
    @if ($suptitle)
        <p class="text-xs uppercase tracking-[0.2em] text-yellow-600 font-semibold mb-2">{{ $suptitle }}</p>
    @endif

    @if ($title)
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-medium title-font mb-4 text-gray-900">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="lg:w-2/3 leading-relaxed text-base">{{ $subtitle }}</p>
    @endif

    @if (trim($slot))
        <div> {{ $slot }}</div>
    @endif
</div>
