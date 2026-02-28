@props(['reviews'])

@php
    $avgRating = round($reviews->avg('rating_value'), 1) ?: 0;
    $total = $reviews->count();
@endphp

<x-ui.sections.wrapper class="bg-gray-50">

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

    <div x-data="reviewsIndexSort(@js(request('sort', 'newest')))"
        x-init="init()">
        <div class="mb-8 flex justify-end">
            <x-ui.buttons.filter :value="request('sort', 'newest')" :client-sort="true" />
        </div>

        <div x-ref="grid" class="columns-1 md:columns-2 xl:columns-3 gap-8 space-y-8">
            @foreach ($reviews as $review)
                <div class="break-inside-avoid" data-rating="{{ (float) $review->rating_value }}"
                    data-published-ts="{{ $review->published_date?->timestamp ?? 0 }}">
                    <x-sections.reviews.review-card :review="$review" />
                </div>
            @endforeach
        </div>
    </div>

</x-ui.sections.wrapper>
