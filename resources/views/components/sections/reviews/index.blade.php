@props(['reviews'])

@php
    $avgRating = round($reviews->avg('rating_value'), 1) ?: 0;
    $total = $reviews->count();
@endphp

<x-ui.sections.wrapper class="bg-gray-50">
    <div class="py-16 md:py-24">
        {{-- HEADER --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start mb-14">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-yellow-600 font-semibold mb-3">
                    Отзывы клиентов
                </p>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Нам доверяют</h3>

                <div class="flex items-start gap-6">
                    <div>
                        <div class="text-5xl font-bold text-gray-900 leading-none">{{ number_format($avgRating, 1) }}
                        </div>
                        @php $starPrefix = 'avg-star'; @endphp
                        <div class="flex text-yellow-500 gap-1 mt-2" aria-label="Средний рейтинг">
                            @for ($i = 1; $i <= 5; $i++)
                                @php
                                    $fill = max(min($avgRating - ($i - 1), 1), 0);
                                    $percent = (int) round($fill * 100);
                                @endphp
                                <svg viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true">
                                    <defs>
                                        <clipPath id="{{ $starPrefix }}-clip-{{ $i }}">
                                            <rect width="{{ $percent }}%" height="24" />
                                        </clipPath>
                                    </defs>
                                    <path fill="#E5E7EB"
                                        d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                                    <path fill="currentColor"
                                        clip-path="url(#{{ $starPrefix }}-clip-{{ $i }})"
                                        d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                                </svg>
                            @endfor
                        </div>
                        <div class="text-sm text-gray-500 mt-2">
                            На основе {{ $total }} отзывов
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- REVIEWS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach ($reviews as $review)
                <x-sections.reviews.review-card :review="$review" :clamp="true" />
            @endforeach
        </div>
    </div>
</x-ui.sections.wrapper>
