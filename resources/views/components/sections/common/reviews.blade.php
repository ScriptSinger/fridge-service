@props(['reviews'])

@php
    $slides = $reviews->map(function ($review) {
        return [
            'name' => $review->name,
            'city' => $review->city,
            'date' => optional($review->created_at)->format('d.m.Y'),
            'text' => $review->text,
            'rating' => $review->rating,
            'avatar' => $review->avatar
                ? \Illuminate\Support\Facades\Storage::disk(config('filesystems.media'))->url($review->avatar)
                : null,
            'source' => $review->source ?? 'google',
            'meta' => collect([$review->device?->type, $review->brand?->name, $review->service?->name])
                ->filter()
                ->implode(' • '),
        ];
    });

    $avgRating = round($reviews->avg('rating'), 1) ?: 5.0;
    $total = $reviews->count();
@endphp

@if ($slides->isNotEmpty())
    <x-ui.sections.wrapper class="text-gray-600">
        <x-ui.sections.header suptitle="Отзывы клиентов" title="Нас рекомендуют">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 space-y-2 sm:space-y-0">
                <div class="text-yellow-500 text-xl" aria-label="Средний рейтинг">
                    <span>★★★★★</span>
                </div>

                <div class="text-gray-900 font-semibold text-lg">
                    {{ $avgRating }} из 5
                </div>

                <div class="text-gray-500 text-sm">
                    На основе {{ $total }} отзывов
                </div>
            </div>

            <div class="sr-only" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="{{ $avgRating }}">
                <meta itemprop="reviewCount" content="{{ $total }}">
                <meta itemprop="bestRating" content="5">
                <meta itemprop="worstRating" content="1">
            </div>
        </x-ui.sections.header>

        <div x-data="reviewsSlider(@js($slides->all()))" x-init="init()" class="relative" @mouseenter="stopAutoplay"
            @mouseleave="startAutoplay" @focusin="stopAutoplay" @focusout="startAutoplay">
            <div class="flex items-center justify-end mb-4">

                <div class="space-x-2">
                    <button type="button"
                        class="p-2 rounded-full border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 cursor-pointer"
                        aria-label="Предыдущий отзыв" @click="prev()">
                        ‹
                    </button>
                    <button type="button"
                        class="p-2 rounded-full border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 cursor-pointer"
                        aria-label="Следующий отзыв" @click="next()">
                        ›
                    </button>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-2xl border border-gray-200 shadow-lg"
                @touchstart="onTouchStart($event)" @touchend="onTouchEnd($event)">
                <div class="flex items-stretch transition-transform duration-500 ease-out" x-ref="track"
                    :style="trackStyle()">

                    <template x-for="(slide, index) in slides" :key="index">
                        <article
                            class="relative shrink-0 border-r border-gray-200 last:border-r-0 basis-full md:basis-1/2 lg:basis-1/3 bg-white p-6"
                            data-card itemprop="review" itemscope itemtype="https://schema.org/Review">
                            <meta itemprop="datePublished" :content="slide.date">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-800 flex items-center justify-center overflow-hidden mr-3">
                                    <template x-if="slide.avatar">
                                        <img :src="slide.avatar" alt="" class="w-full h-full object-cover"
                                            itemprop="image" />
                                    </template>
                                    <template x-if="!slide.avatar">
                                        <span class="font-semibold" x-text="slide.name.substring(0, 1)"></span>
                                    </template>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900" x-text="slide.name" itemprop="author"></p>
                                    <p class="text-sm text-gray-500" x-text="slide.city"></p>
                                </div>
                                <div class="ml-auto">
                                    <img :src="`{{ asset('assets/images/svg') }}/${slide.source}.svg`"
                                        :alt="slide.source"
                                        :title="`Опубликовано на ${slide.source.charAt(0).toUpperCase() + slide.source.slice(1)}`"
                                        class="h-6 w-6"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/svg/google.svg') }}';">
                                </div>
                            </div>
                            <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2 pt-2">
                                <div class="flex text-yellow-500" aria-label="Рейтинг" itemprop="reviewRating" itemscope
                                    itemtype="https://schema.org/Rating">
                                    <meta itemprop="ratingValue" :content="slide.rating">
                                    <template x-for="i in 5" :key="i">
                                        <svg viewBox="0 0 24 24" class="w-5 h-5"
                                            :class="{ 'opacity-30': i > slide.rating }" fill="currentColor">
                                            <path
                                                d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                                        </svg>
                                    </template>
                                </div>
                                <img src="{{ asset('assets/images/svg/verify.svg') }}" alt="Verified"
                                    class="h-5 w-5 shrink-0">
                            </div>
                            <div class="pb-4">
                                <p class="text-gray-700 leading-6 line-clamp-3 min-h-[4.5rem]" x-text="slide.text"
                                    itemprop="reviewBody"></p>
                            </div>
                        </article>
                    </template>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <a href="{{ route('reviews.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-full text-sm font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900">
                    Смотреть все отзывы
                    <span class="ml-2">→</span>
                </a>
            </div>
        </div>
    </x-ui.sections.wrapper>
@endif
