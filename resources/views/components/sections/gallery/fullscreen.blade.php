<div x-cloak x-show="isFullscreen" class="fixed inset-0 z-[100] bg-black/95" @click.self="closeFullscreen()">
    <div class="relative flex h-full w-full items-center justify-center" @touchstart="onTouchStart($event)"
        @touchend="onTouchEnd($event, 'fullscreen')">
        <button type="button"
            class="absolute right-4 top-4 z-20 flex h-11 w-11 cursor-pointer items-center justify-center rounded-full bg-white/90 text-2xl text-gray-900 hover:bg-white"
            aria-label="Закрыть полноэкранную галерею" @click="closeFullscreen()">
            <span class="leading-none">×</span>
        </button>

        <div class="relative h-full w-full overflow-hidden">
            <div class="flex h-full transition-transform duration-500 ease-out"
                :style="`width: ${slides.length * 100}%; transform: translateX(-${fullscreenCurrent * (100 / slides.length)}%);`">
                <template x-for="(slide, index) in slides" :key="`fullscreen-${index}`">
                    <article class="relative h-full shrink-0" :style="`width: ${100 / slides.length}%`">
                        <img :src="slide.image" :alt="slide.image_alt" loading="lazy" decoding="async"
                            width="1920" height="1080" class="h-full w-full object-contain object-center">
                        <div
                            class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white md:p-10">
                            <p class="mb-1 text-xs font-medium tracking-widest text-yellow-400 md:text-sm"
                                x-text="slide.subtitle"></p>
                            <h3 class="text-sm font-semibold md:text-base lg:text-lg text-yellow-400"
                                x-text="slide.title"></h3>
                            <p class="mb-1 text-sm text-white/90 md:text-base" x-text="slide.description"></p>
                        </div>
                    </article>
                </template>
            </div>
        </div>

        <button type="button"
            class="absolute left-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
            aria-label="Предыдущий слайд" @click="prevFullscreen()">
            <span class="text-2xl leading-none">‹</span>
        </button>
        <button type="button"
            class="absolute right-4 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
            aria-label="Следующий слайд" @click="nextFullscreen()">
            <span class="text-2xl leading-none">›</span>
        </button>
    </div>
</div>
