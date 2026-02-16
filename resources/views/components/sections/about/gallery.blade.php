@props(['galleries'])

@php($slides = $galleries->filter(fn($item) => !empty($item->image))->values())

@if ($slides->isNotEmpty())
    <x-ui.sections.wrapper>
        <x-ui.sections.header title="Примеры выполненных работ"
            subtitle="Реальные кейсы и типовые задачи, которые мы решаем" />

        <div class="mx-auto w-full px-4 md:px-0"
            x-data="aboutGallerySlider(@js($slides->map(fn($item) => [
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'description' => $item->description,
                'image' => asset('storage/' . $item->image),
                'image_alt' => $item->image_alt ?: $item->title,
            ])->all()))">
            <div class="relative overflow-hidden rounded-2xl border border-gray-200 shadow-lg"
                @touchstart="onTouchStart($event)" @touchend="onTouchEnd($event)">
                <div class="flex transition-transform duration-500 ease-out"
                    :style="`width: ${(slides.length / perView) * 100}%; transform: translateX(-${current * (100 / slides.length)}%);`">
                    <template x-for="(slide, index) in slides" :key="index">
                        <article class="relative shrink-0 border-r border-gray-200 last:border-r-0"
                            :style="`width: ${100 / slides.length}%`">
                            <img :src="slide.image" :alt="slide.image_alt"
                                class="h-64 w-full object-cover object-center md:h-72 lg:h-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 text-white md:p-8">
                                <p class="mb-1 text-xs font-medium tracking-widest text-yellow-400 md:text-sm"
                                    x-text="slide.subtitle"></p>
                                <h3 class="mb-2 text-lg font-semibold md:text-2xl" x-text="slide.title"></h3>
                                <p class="text-sm text-white/90 md:text-base" x-text="slide.description"></p>
                            </div>
                        </article>
                    </template>
                </div>

                <button type="button"
                    class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                    aria-label="Предыдущий слайд" @click="prev()">
                    <span class="text-xl leading-none">‹</span>
                </button>
                <button type="button"
                    class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                    aria-label="Следующий слайд" @click="next()">
                    <span class="text-xl leading-none">›</span>
                </button>
            </div>

            <div class="mt-4 flex items-center justify-center gap-2">
                <template x-for="dotIndex in maxIndex + 1" :key="`dot-${dotIndex}`">
                    <button type="button" class="h-2.5 cursor-pointer rounded-full transition-all"
                        :class="current === (dotIndex - 1) ? 'w-7 bg-yellow-500' : 'w-2.5 bg-gray-300 hover:bg-gray-400'"
                        @click="goTo(dotIndex - 1)" :aria-label="`Перейти к слайду ${dotIndex}`"></button>
                </template>
            </div>
        </div>
    </x-ui.sections.wrapper>
@endif
