@props(['slides'])

<div class="mx-auto w-full" x-data="gallerySlider(@js($slides))" x-init="init()">
    {{-- Up to a full row fits without scrolling, so a slider would only add idle arrows and empty space --}}
    @if (count($slides) <= 3)
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <x-sections.gallery.slide-card :slides="$slides" static />
        </div>
    @else
        <div class="relative overflow-hidden rounded-2xl border border-gray-200 shadow-lg" @touchstart="onTouchStart($event)"
            @touchend="onTouchEnd($event)">
            <div class="flex transition-transform duration-500 ease-out" x-ref="track"
                :style="cardStep ? `transform: translateX(-${current * cardStep}px);` : ''">
                <x-sections.gallery.slide-card :slides="$slides" />
            </div>

            <button type="button"
                class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                aria-label="Предыдущий слайд" x-show="maxIndex > 0" x-cloak @click="prev()">
                <span class="text-xl leading-none">‹</span>
            </button>
            <button type="button"
                class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full bg-white/85 text-gray-900 hover:bg-white"
                aria-label="Следующий слайд" x-show="maxIndex > 0" x-cloak @click="next()">
                <span class="text-xl leading-none">›</span>
            </button>
        </div>

    @endif

    <x-sections.gallery.fullscreen />
</div>
