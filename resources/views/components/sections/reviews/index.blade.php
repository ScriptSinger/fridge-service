@props(['reviews'])

@php
    $avgRating = round($reviews->avg('rating_value'), 1) ?: 0;
    $total = $reviews->count();
    $sourceOptions = $reviews->pluck('source')
        ->filter()
        ->map(fn($source) => strtolower((string) $source))
        ->unique()
        ->values();
    $activeSource = strtolower((string) request('source', 'all'));
    $sourceLabels = ['all' => 'Все источники'];
    foreach ($sourceOptions as $sourceOption) {
        $sourceLabels[$sourceOption] = mb_strtoupper(mb_substr($sourceOption, 0, 1)) . mb_substr($sourceOption, 1);
    }
@endphp

<x-ui.sections.wrapper class="bg-gray-50">

    <x-ui.sections.header suptitle="Средний рейтинг" title="Нас рекомендуют">
        <div class="flex flex-col md:flex-row md:items-center sm:space-x-3 space-y-2 sm:space-y-0">
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

    <div x-data="reviewsIndexSort(@js(request('sort', 'newest')), @js(request()->boolean('with_photo')), @js($activeSource))"
        x-init="init()">
        <div class="mb-8 flex flex-wrap items-center justify-end gap-3">
            <div x-data="{ open: false, options: @js($sourceLabels) }" class="relative inline-block text-left">
                <button type="button" @click="open = !open"
                    class="inline-flex items-center justify-between gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition"
                    aria-haspopup="true" :aria-expanded="open">
                    <span x-text="options[source] ?? options.all">{{ $sourceLabels[$activeSource] ?? 'Все источники' }}</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.7a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black/5 z-20">
                    <div class="py-1 text-sm">
                        @foreach ($sourceLabels as $sourceKey => $sourceLabel)
                            <button type="button"
                                @click="source = '{{ $sourceKey }}'; open = false; $dispatch('reviews-source-change', { source: '{{ $sourceKey }}' })"
                                :class="source === '{{ $sourceKey }}' ? 'bg-gray-50 font-semibold text-gray-900' :
                                    'text-gray-700'"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                                {{ $sourceLabel }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="button" @click="toggleOnlyWithPhoto()"
                :class="onlyWithPhoto ? 'bg-yellow-500 border-yellow-500 text-white' :
                    'bg-white border-gray-200 text-gray-700 hover:border-gray-300 hover:bg-gray-50'"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium transition cursor-pointer">
                Только с фото
            </button>
            <x-ui.buttons.filter :value="request('sort', 'newest')" :client-sort="true" />
        </div>

        <div x-ref="grid" class="columns-1 md:columns-2 xl:columns-3 gap-8 space-y-8">
            @foreach ($reviews as $review)
                <div class="break-inside-avoid" data-rating="{{ (float) $review->rating_value }}"
                    data-published-ts="{{ $review->published_date?->timestamp ?? 0 }}"
                    data-has-photo="{{ $review->image_url ? '1' : '0' }}"
                    data-source="{{ strtolower((string) ($review->source ?? 'google')) }}">
                    <x-sections.reviews.review-card :review="$review" />
                </div>
            @endforeach
        </div>
    </div>

</x-ui.sections.wrapper>
