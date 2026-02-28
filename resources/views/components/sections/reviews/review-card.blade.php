@props(['review', 'clamp' => true])

@php
    $name = $review->name;
    $city = $review->city;
    $date = optional($review->published_date)->toDateString();
    $dateLabel = $review->published_date_formatted;
    $text = $review->text;
    $rating = $review->rating ?? 0;
    $avatar = $review->avatar_url;
    $image = $review->image_url;
    $source = $review->source ?? 'google';
    $metaItems = collect([$review->device?->type, $review->brand?->name, $review->service?->name])
        ->filter()
        ->values();
@endphp

<article x-data="{ imageModalOpen: false }"
    x-init="$watch('imageModalOpen', (open) => { document.body.style.overflow = open ? 'hidden' : ''; })"
    class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col justify-between"
    itemprop="review" itemscope itemtype="https://schema.org/Review">

    @if ($date)
        <meta itemprop="datePublished" content="{{ $date }}">
    @endif

    <div class="flex items-center mb-4">
        <div
            class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-800 flex items-center justify-center overflow-hidden mr-3">
            @if ($avatar)
                <img src="{{ $avatar }}" alt="{{ $name }}" class="w-full h-full object-cover"
                    itemprop="image" />
            @else
                <span class="font-semibold">{{ mb_substr($name, 0, 1) }}</span>
            @endif
        </div>
        <div>
            <p class="font-semibold text-gray-900" itemprop="author">{{ $name }}</p>
            @if ($date)
                <p class="text-sm text-gray-500">{{ $dateLabel }}</p>
            @endif
        </div>
        <div class="ml-auto">
            <img src="{{ asset("assets/images/svg/{$source}.svg") }}" alt="{{ $source }}" class="h-6 w-6"
                onerror="this.onerror=null;this.src='{{ asset('assets/images/svg/google.svg') }}';">
        </div>
    </div>

    <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2 pt-2">
        <div class="flex text-yellow-500" aria-label="Рейтинг" itemprop="reviewRating" itemscope
            itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="{{ $rating }}">
            @for ($i = 1; $i <= 5; $i++)
                <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" @class(['opacity-30' => $i > $rating])>
                    <path d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                </svg>
            @endfor
        </div>
        <img src="{{ asset('assets/images/svg/verify.svg') }}" alt="Verified" class="h-5 w-5 shrink-0">
    </div>

    <div class="pb-4">
        @if ($image)
            <button type="button" @click.stop="imageModalOpen = true"
                class="mb-4 block w-full overflow-hidden rounded-xl border border-gray-100 hover:shadow-lg transition duration-300 cursor-zoom-in">
                <img src="{{ $image }}" alt="Фото отзыва {{ $name }}"
                    class="w-full h-48 sm:h-56 md:h-64 object-cover" loading="lazy">
            </button>
        @endif

        <p class="text-gray-700 leading-6" itemprop="reviewBody">
            {{ $text }}
        </p>
    </div>

    @if ($metaItems->isNotEmpty())
        <div class="flex flex-wrap gap-2">
            @foreach ($metaItems as $metaItem)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                    {{ $metaItem }}
                </span>
            @endforeach
        </div>
    @endif

    @if ($image)
        <div x-cloak x-show="imageModalOpen" x-transition.opacity @keydown.escape.window="imageModalOpen = false"
            @click="imageModalOpen = false" class="fixed inset-0 z-50 bg-black/80 p-4 sm:p-6">
            <div class="relative mx-auto flex h-full max-w-5xl items-center justify-center" @click.stop>
                <button type="button" @click="imageModalOpen = false"
                    class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[60] cursor-pointer"
                    aria-label="Закрыть">
                    <span class="text-2xl leading-none">&times;</span>
                </button>

                <img src="{{ $image }}" alt="Фото отзыва {{ $name }}"
                    class="max-h-full w-auto max-w-full rounded-xl object-contain">
            </div>
        </div>
    @endif
</article>
