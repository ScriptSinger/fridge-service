@php
    $metaItems = collect([
        $gallery->device
            ? ['label' => $gallery->device->type, 'url' => route('devices.show', $gallery->device)]
            : null,
        ($gallery->device && $gallery->brand)
            ? ['label' => $gallery->brand->name, 'url' => route('devices.brands.show', [$gallery->device, $gallery->brand])]
            : ($gallery->brand ? ['label' => $gallery->brand->name, 'url' => null] : null),
        $gallery->service
            ? ['label' => $gallery->service->name, 'url' => route('services.show', [$gallery->service->device, $gallery->service->slug])]
            : null,
        ($gallery->problem && $gallery->problem->is_active)
            ? ['label' => $gallery->problem->title, 'url' => $gallery->problem->device ? route('problems.show', [$gallery->problem->device, $gallery->problem->slug]) : null]
            : null,
        ($gallery->errorCode && $gallery->errorCode->is_active)
            ? ['label' => $gallery->errorCode->title, 'url' => $gallery->errorCode->device ? route('error-codes.show', [$gallery->errorCode->device, $gallery->errorCode->slug]) : null]
            : null,
    ])->filter()->values();
@endphp

<x-layouts.app :title="$metaTitle" :description="$description">
    <x-ui.breadcrumbs route="gallery.show" :model="$gallery" />
    <x-sections.hero
        :model="null"
        :h1="$title"
        :subtitle="$gallery->subtitle"
        :image="$gallery->image_url"
        :imageAlt="$gallery->image_alt ?: $title"
        :zoomable="true" />

    <x-ui.sections.wrapper id="gallery-detail">
        <div @class([
                'grid gap-8 lg:items-start',
                'lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]' => (bool) $gallery->description,
            ])
            x-data="galleryCard(null)" @hero-image-zoom.window="openModal()">
            @if ($gallery->description)
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:self-start">
                    <div
                        x-data="contentLightbox()"
                        x-init="init()"
                        class="prose prose-sm prose-gray max-w-none prose-headings:text-gray-900 prose-h2:mt-5 prose-h2:mb-2 prose-h3:mt-4 prose-h3:mb-2 prose-img:mx-auto prose-img:rounded-2xl prose-img:shadow-sm prose-img:cursor-zoom-in prose-figure:mx-auto prose-figcaption:text-center prose-table:text-sm prose-th:bg-gray-50">
                        {!! $gallery->description !!}

                        <template x-teleport="body">
                            <div x-cloak x-show="open" x-transition.opacity @keydown.window="handleKeydown($event)"
                                @click="close()" class="fixed inset-0 z-[120] bg-black/80 p-4 sm:p-6"
                                role="dialog" aria-modal="true" :aria-label="alt || 'Изображение'" tabindex="-1"
                                x-ref="dialog">
                                <div class="relative mx-auto flex h-full max-w-6xl items-center justify-center"
                                    @click.stop>
                                    <button type="button" @click="close()"
                                        class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[130] cursor-pointer"
                                        aria-label="Закрыть">
                                        <span class="text-2xl leading-none">&times;</span>
                                    </button>

                                    <img :src="src" :alt="alt" decoding="async"
                                        class="max-h-full w-auto max-w-full rounded-xl object-contain">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            @endif

            <template x-teleport="body">
                <div x-cloak x-show="imageModalOpen" x-transition.opacity @keydown.escape.window="closeModal()"
                    @click="closeModal()" class="fixed inset-0 z-[100] bg-black/80 p-4 sm:p-6"
                    role="dialog" aria-modal="true" aria-label="Изображение" tabindex="-1">
                    <div class="relative mx-auto flex h-full max-w-6xl items-center justify-center" @click.stop>
                        <button type="button" @click="closeModal()"
                            class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[110] cursor-pointer"
                            aria-label="Закрыть">
                            <span class="text-2xl leading-none">&times;</span>
                        </button>

                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->image_alt ?: $title }}"
                            class="max-h-full w-auto max-w-full rounded-xl object-contain">
                    </div>
                </div>
            </template>

            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Детали работы</h2>

                @if ($gallery->published_date_formatted)
                    <div class="mb-4 text-sm text-gray-600">
                        Дата: {{ $gallery->published_date_formatted }}
                    </div>
                @endif

                @if ($metaItems->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
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

                <div class="mt-6">
                    <x-ui.buttons.section-link :href="route('gallery.index')" label="Все работы" />
                </div>
            </div>
        </div>
    </x-ui.sections.wrapper>

    <x-sections.contact :model="null" />
    <x-ui.scroll-up />
</x-layouts.app>
