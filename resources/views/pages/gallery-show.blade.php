@php
    $metaItems = collect([
        $gallery->device
            ? ['label' => $gallery->device->type, 'url' => route('devices.show', $gallery->device)]
            : null,
        ($gallery->device && $gallery->brand)
            ? ['label' => $gallery->brand->name, 'url' => route('devices.brands.show', [$gallery->device, $gallery->brand])]
            : ($gallery->brand ? ['label' => $gallery->brand->name, 'url' => null] : null),
        $gallery->service ? ['label' => $gallery->service->name, 'url' => null] : null,
    ])->filter()->values();
@endphp

<x-layouts.app :title="$title" :description="$description">
    <x-ui.breadcrumbs route="gallery.show" :model="$gallery" />
    <x-sections.hero
        :model="null"
        :h1="$title"
        :subtitle="$gallery->subtitle" />

    <x-ui.sections.wrapper id="gallery-detail">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] lg:items-start">
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:self-start"
                x-data="galleryCard(null)">
                <a href="{{ $gallery->image_url }}" @click.prevent="openModal()"
                    class="block w-full overflow-hidden rounded-xl cursor-zoom-in">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->image_alt ?: $title }}"
                        class="w-full rounded-xl object-cover">
                </a>

                @if ($gallery->description)
                    <div
                        x-data="contentLightbox()"
                        x-init="init()"
                        class="mt-6 text-gray-700 text-sm leading-6 [&_p]:my-3 [&_ul]:my-3 [&_ol]:my-3 [&_ul]:list-disc [&_ol]:list-decimal [&_ul]:pl-6 [&_ol]:pl-6 [&_li]:my-1 [&_h2]:text-xl [&_h2]:font-semibold [&_h2]:text-gray-900 [&_h2]:mt-5 [&_h2]:mb-2 [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:text-gray-900 [&_h3]:mt-4 [&_h3]:mb-2 [&_img]:cursor-zoom-in">
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
            </div>

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
