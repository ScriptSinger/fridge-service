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
    <x-ui.sections.wrapper class="text-gray-600" itemscope itemtype="https://schema.org/Review">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-yellow-600 font-semibold mb-2">Отзывы клиентов</p>
                <h3 class="sm:text-3xl text-2xl font-semibold text-gray-900 mb-3">Нас рекомендуют в Уфе</h3>
                <div class="flex items-center space-x-3">
                    <div class="flex text-yellow-500 text-xl" aria-label="Средний рейтинг">
                        <span>★★★★★</span>
                    </div>
                    <div class="text-gray-900 font-semibold text-lg">{{ $avgRating }} из 5</div>
                    <div class="text-gray-500 text-sm">На основе {{ $total }} отзывов</div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                <div class="bg-yellow-50 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium">Гарантия 1 год на
                    ремонт</div>
                <div class="text-sm text-gray-600">Работаем с 2008 года</div>
            </div>
        </div>

        <div x-data="reviewsSlider(@js($slides->all()), { autoplay: true, interval: 5500 })" x-init="init()" class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <template x-for="i in pages" :key="i">
                        <button type="button" @click="goToPage(i-1)" :class="dotClass(i - 1)"
                            class="h-2 w-2 rounded-full"></button>
                    </template>
                </div>
                <div class="space-x-2">
                    <button type="button" @click="prev" @mouseenter="stopAutoplay" @mouseleave="startAutoplay"
                        class="p-2 rounded-full border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300"
                        aria-label="Предыдущий отзыв">
                        ‹
                    </button>
                    <button type="button" @click="next" @mouseenter="stopAutoplay" @mouseleave="startAutoplay"
                        class="p-2 rounded-full border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300"
                        aria-label="Следующий отзыв">
                        ›
                    </button>
                </div>
            </div>

                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" x-ref="track" :style="trackStyle()">
                    <template x-for="(slide, index) in slides" :key="index">
                        <article
                            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full mx-2 hover:shadow-md transition-shadow basis-full md:basis-1/2 lg:basis-1/3 xl:basis-1/4 shrink-0"
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
                                    <img src="{{ asset('assets/images/svg/icon.svg') }}" alt="Source icon"
                                        class="h-6 w-6">
                                </div>
                            </div>
                            <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2">
                                <div class="flex text-yellow-500" aria-label="Рейтинг" itemprop="reviewRating" itemscope
                                    itemtype="https://schema.org/Rating">
                                    <meta itemprop="ratingValue" :content="slide.rating">
                                    <template x-for="i in 5" :key="i">
                                        <svg viewBox="0 0 24 24" class="w-4 h-4"
                                            :class="{ 'opacity-30': i > slide.rating }" fill="currentColor">
                                            <path
                                                d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                                        </svg>
                                    </template>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed line-clamp-2 mb-3" x-text="slide.text"
                                itemprop="reviewBody"></p>
                            <span
                                class="inline-flex items-center text-xs font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-700"
                                x-text="slide.meta || 'Ремонт бытовой техники'"></span>
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
                <div class="flex items-center text-sm text-gray-600 space-x-2">
                    <span
                        class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-yellow-100 text-yellow-700 font-semibold">★</span>
                    <span>Гарантия 1 год на ремонт</span>
                </div>
            </div>
        </div>
    </x-ui.sections.wrapper>
@endif
