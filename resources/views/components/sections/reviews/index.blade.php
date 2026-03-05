@props(['reviews', 'avgRating' => 0, 'total' => 0, 'sourceLabels' => [], 'activeSource' => 'all'])

@php
    if (empty($sourceLabels)) {
        $sourceLabels = ['all' => 'Все источники'];
    }
@endphp

<x-ui.sections.wrapper class="bg-gray-50">

    <x-ui.sections.header suptitle="Средний рейтинг" title="Нас рекомендуют">
            <div class="flex flex-col items-center gap-2 text-center md:flex-row md:gap-3 md:text-left">
            <div class="text-yellow-500 text-xl" aria-label="Средний рейтинг">
                <x-ui.rating :rating="$avgRating" />
            </div>

            <div class="text-gray-900 font-semibold text-lg">
                {{ $avgRating }} из 5
            </div>

            <div class="text-gray-500 text-sm">
                На основе {{ $total }} отзывов
            </div>
        </div>

        <div class="sr-only" itemscope itemtype="https://schema.org/LocalBusiness">
            <meta itemprop="name" content="{{ config('app.name') }}">
            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="{{ $avgRating }}">
                <meta itemprop="reviewCount" content="{{ $total }}">
                <meta itemprop="bestRating" content="5">
                <meta itemprop="worstRating" content="1">
            </div>
        </div>
    </x-ui.sections.header>

    <div x-data="reviewsIndexSort()" x-init="init()">
        <div class="mb-8 flex flex-col items-stretch gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
            <x-ui.buttons.filter :value="$activeSource" :options="$sourceLabels" :query-key="'source'" :scroll-on-navigate="true"
                :full-width-mobile="true" />

            <button type="button" @click="toggleOnlyWithPhoto()"
                :class="onlyWithPhoto ? 'bg-yellow-500 border-yellow-500 text-white' :
                    'bg-white border-gray-200 text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                class="inline-flex w-full items-center justify-start gap-2 px-4 py-2 text-left rounded-xl border text-sm font-medium transition cursor-pointer sm:w-auto sm:justify-center sm:text-center">
                Только с фото
            </button>
            <x-ui.buttons.filter :value="request('sort', 'newest')" :query-key="'sort'" :scroll-on-navigate="true" :full-width-mobile="true" />
        </div>

        <div x-ref="grid" class="relative space-y-4 md:space-y-0">
            @foreach ($reviews as $review)
                <div data-rating="{{ (float) $review->rating }}"
                    data-published-ts="{{ $review->published_date?->timestamp ?? 0 }}"
                    data-has-photo="{{ $review->image_url ? '1' : '0' }}"
                    data-source="{{ strtolower((string) ($review->source ?? 'google')) }}">
                    <x-sections.reviews.review-card :review="$review" />
                </div>
            @endforeach
        </div>

        @if ($reviews->isEmpty())
            <div class="rounded-2xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-600">
                По выбранному фильтру пока нет отзывов.
            </div>
        @else
            <div x-cloak
                x-show="($data.onlyWithPhoto ?? false) && (($data.visibleCardsCount ?? 0) === 0) && (($data.totalCardsCount ?? 0) > 0)"
                class="rounded-2xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-600">
                Нет отзывов с фото на этой странице.
            </div>
        @endif

        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    </div>

</x-ui.sections.wrapper>
