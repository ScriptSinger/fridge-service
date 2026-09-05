@props(['gallery'])

@php
    $title = $gallery->title ?: 'Выполненный ремонт';
    $subtitle = $gallery->subtitle;
    $description = $gallery->subtitle;
    $image = $gallery->image_url;
    $imageAlt = $gallery->image_alt ?: $title;
    $date = optional($gallery->published_date)->toDateString();
    $dateLabel = $gallery->published_date_formatted;
    $metaItems = collect([
        $gallery->device
            ? ['label' => $gallery->device->type, 'url' => route('devices.show', $gallery->device)]
            : null,
        $gallery->brand
            ? [
                'label' => $gallery->brand->name,
                'url' => $gallery->device ? route('devices.brands.show', [$gallery->device, $gallery->brand]) : null,
            ]
            : null,
        $gallery->service
            ? [
                'label' => $gallery->service->name,
                'url' => $gallery->service->device ? route('services.show', [$gallery->service->device, $gallery->service->slug]) : null,
            ]
            : null,
        $gallery->problem
            ? [
                'label' => $gallery->problem->title,
                'url' => $gallery->problem->device ? route('problems.show', [$gallery->problem->device, $gallery->problem->slug]) : null,
            ]
            : null,
    ])->filter()->values();
    $detailUrl = $gallery->slug ? route('gallery.show', $gallery) : null;
@endphp

<article x-data="galleryCard(@js($detailUrl))"
    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col" itemscope
    itemtype="https://schema.org/ImageObject">
    <meta itemprop="name" content="{{ $title }}">
    @if ($date)
        <meta itemprop="datePublished" content="{{ $date }}">
    @endif
    @if ($description)
        <meta itemprop="description" content="{{ $description }}">
    @endif

    <a href="{{ $detailUrl ?? route('gallery.index') }}" @click.prevent="openModal()"
        class="mb-4 block w-full overflow-hidden rounded-xl border border-gray-100 cursor-zoom-in">
        <img src="{{ $image }}" alt="{{ $imageAlt }}" width="640" height="480"
            class="w-full h-56 sm:h-64 object-cover" loading="lazy" itemprop="contentUrl">
    </a>

    <div class="mb-3 flex min-w-0 items-start justify-between gap-4">
        @if ($detailUrl)
            <a href="{{ $detailUrl }}" class="min-w-0 break-words text-gray-900 text-lg font-semibold leading-6 hover:text-yellow-600">
                {{ $title }}
            </a>
        @else
            <h3 class="min-w-0 break-words text-gray-900 text-lg font-semibold leading-6">{{ $title }}</h3>
        @endif
        @if ($dateLabel)
            <span class="text-xs text-gray-500 shrink-0">{{ $dateLabel }}</span>
        @endif
    </div>

    @if ($description)
        <p class="text-gray-700 text-sm leading-6 mb-4">{{ $description }}</p>
    @endif

    @if ($metaItems->isNotEmpty())
        <div class="mt-auto flex flex-wrap gap-2">
            @foreach ($metaItems as $metaItem)
                @if ($metaItem['url'])
                    <a href="{{ $metaItem['url'] }}"
                        class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                        {{ $metaItem['label'] }}
                    </a>
                @else
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                        {{ $metaItem['label'] }}
                    </span>
                @endif
            @endforeach
        </div>
    @endif

    <template x-teleport="body">
        <div x-cloak x-show="imageModalOpen" x-transition.opacity @keydown.escape.window="closeModal()"
            @click="closeModal()" class="fixed inset-0 z-[100] bg-black/80 p-4 sm:p-6">
            <div class="relative mx-auto flex h-full max-w-6xl items-center justify-center" @click.stop>
                <button type="button" @click="closeModal()"
                    class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[110] cursor-pointer"
                    aria-label="Закрыть">
                    <span class="text-2xl leading-none">&times;</span>
                </button>

                <img src="{{ $image }}" alt="{{ $imageAlt }}"
                    class="max-h-full w-auto max-w-full rounded-xl object-contain">
            </div>
        </div>
    </template>
</article>
