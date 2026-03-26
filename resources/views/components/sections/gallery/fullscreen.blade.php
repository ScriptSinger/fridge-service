<div x-cloak x-show="isFullscreen" class="fixed inset-0 z-[100] bg-black/95" @click.self="closeFullscreen()">
    <div class="relative flex h-full w-full items-center justify-center" @touchstart="onTouchStart($event)"
        @touchend="onTouchEnd($event, 'fullscreen')">

        <!-- Закрытие -->
        <button type="button"
            class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-white/90 text-2xl text-gray-900 hover:bg-white cursor-pointer"
            aria-label="Закрыть галерею" @click="closeFullscreen()">×</button>

        <!-- Слайды -->
        <div class="relative w-full overflow-hidden">
            <div class="flex transition-transform duration-500 ease-out"
                :style="`width: ${slides.length * 100}%; transform: translateX(-${fullscreenCurrent * (100 / slides.length)}%);`">

                <template x-for="(slide, index) in slides" :key="`fullscreen-${index}`">
                    <figure class="relative shrink-0 flex flex-col justify-center items-center"
                        :style="`width: ${100 / slides.length}%`">

                        <!-- Изображение -->
                        <img :src="slide.image" :alt="slide.image_alt" class="max-h-[80vh] w-auto object-contain"
                            loading="lazy" decoding="async">

                        <!-- Текст под изображением -->
                        <figcaption class="w-full p-3 md:p-6 text-white">
                            <h3 class="text-sm font-semibold md:text-base lg:text-lg text-yellow-400"
                                x-text="slide.title"></h3>
                            <p class="mt-2 text-sm text-white/80 md:text-base" x-text="slide.subtitle"></p>
                            <a :href="slide.url"
                                class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-gray-900 hover:bg-white"
                                x-show="slide.url">
                                Подробнее
                                <span aria-hidden="true">→</span>
                            </a>
                        </figcaption>
                    </figure>
                </template>

            </div>
        </div>

        <!-- Навигация -->
        <button type="button"
            class="absolute left-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white cursor-pointer"
            aria-label="Предыдущий слайд" @click="prevFullscreen()">‹</button>
        <button type="button"
            class="absolute right-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white cursor-pointer"
            aria-label="Следующий слайд" @click="nextFullscreen()">›</button>

    </div>
</div>
