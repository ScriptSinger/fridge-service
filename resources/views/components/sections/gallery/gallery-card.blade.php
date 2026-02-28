@props(['gallery'])

@php
    $title = $gallery->title ?: 'Выполненный ремонт';
    $subtitle = $gallery->subtitle;
    $description = $gallery->description;
    $image = $gallery->image_url;
    $imageAlt = $gallery->image_alt ?: $title;
    $dateLabel = optional($gallery->created_at)->format('d.m.Y');
    $metaItems = collect([$gallery->device?->type, $gallery->brand?->name, $gallery->service?->name])->filter()->values();
@endphp

<article x-data="{ imageModalOpen: false }"
    x-init="$watch('imageModalOpen', (open) => { document.body.style.overflow = open ? 'hidden' : ''; })"
    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col" itemscope
    itemtype="https://schema.org/ImageObject">
    <meta itemprop="name" content="{{ $title }}">
    @if ($description)
        <meta itemprop="description" content="{{ $description }}">
    @endif

    <button type="button" @click="imageModalOpen = true"
        class="mb-4 block w-full overflow-hidden rounded-xl border border-gray-100 cursor-zoom-in">
        <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-56 sm:h-64 object-cover" loading="lazy"
            itemprop="contentUrl">
    </button>

    <div class="mb-3 flex items-start justify-between gap-4">
        <h3 class="text-gray-900 text-lg font-semibold leading-6">{{ $title }}</h3>
        @if ($dateLabel)
            <span class="text-xs text-gray-500 shrink-0">{{ $dateLabel }}</span>
        @endif
    </div>

    @if ($subtitle)
        <p class="text-sm text-yellow-600 font-medium mb-2">{{ $subtitle }}</p>
    @endif

    @if ($description)
        <p class="text-gray-700 text-sm leading-6 mb-4">{{ $description }}</p>
    @endif

    @if ($metaItems->isNotEmpty())
        <div class="mt-auto flex flex-wrap gap-2">
            @foreach ($metaItems as $metaItem)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                    {{ $metaItem }}
                </span>
            @endforeach
        </div>
    @endif

    <div x-cloak x-show="imageModalOpen" x-transition.opacity @keydown.escape.window="imageModalOpen = false"
        @click="imageModalOpen = false" class="fixed inset-0 z-50 bg-black/80 p-4 sm:p-6">
        <div class="relative mx-auto flex h-full max-w-6xl items-center justify-center" @click.stop>
            <button type="button" @click="imageModalOpen = false"
                class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[60]"
                aria-label="Закрыть">
                <span class="text-2xl leading-none">&times;</span>
            </button>

            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="max-h-full w-auto max-w-full rounded-xl object-contain">
        </div>
    </div>
</article>
