@props(['slides'])

<div class="mx-auto w-full" x-data="gallerySlider(@js($slides))" x-init="init()">
    <div class="relative overflow-hidden rounded-2xl border border-gray-200 shadow-lg" @touchstart="onTouchStart($event)"
        @touchend="onTouchEnd($event)">
        <div class="flex transition-transform duration-500 ease-out" x-ref="track"
            :style="cardStep ? `transform: translateX(-${current * cardStep}px);` : ''">
            <x-sections.gallery.slide-card />
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

    <div class="mt-4 flex items-center">
        <x-ui.buttons.section-link :href="route('gallery.index')" label="Смотреть все работы" />
    </div>

    <div class="mt-6 flex justify-center" x-show="hasHiddenSlides" x-cloak>
        <button type="button"
            class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-yellow-600 cursor-pointer"
            @click="showMore()">
            <span x-text="`Показать ещё (${hiddenCount})`"></span>
        </button>
    </div>

    <x-sections.gallery.fullscreen />
</div>
