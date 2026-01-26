<div class="flex flex-col w-full mb-12 text-center md:text-left">
    @if ($title)
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="lg:w-2/3 leading-relaxed text-base">{{ $subtitle }}</p>
    @endif
</div>
