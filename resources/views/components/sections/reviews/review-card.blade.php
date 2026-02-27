@props(['review', 'clamp' => true])

@php
    $name = $review->name;
    $city = $review->city;
    $date = optional($review->published_date)->toDateString();
    $dateLabel = $review->published_date_formatted;
    $text = $review->text;
    $rating = $review->rating ?? 0;
    $avatar = $review->avatar
        ? \Illuminate\Support\Facades\Storage::disk(config('filesystems.media'))->url($review->avatar)
        : null;
    $source = $review->source ?? 'google';
    $meta = collect([$review->device?->type, $review->brand?->name, $review->service?->name])
        ->filter()
        ->implode(' • ');
@endphp

<article x-data="{ modal: false }"
    class="relative shrink-0 border-r border-gray-200 last:border-r-0 cursor-pointer basis-full md:basis-1/2 lg:basis-1/3 bg-white p-6"
    @click="modal = true" @keydown.escape.window="modal = false" itemprop="review" itemscope
    itemtype="https://schema.org/Review">

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
            @if ($city)
                <p class="text-sm text-gray-500">{{ $city }}</p>
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
        <p class="text-gray-700 leading-6 {{ $clamp ? 'line-clamp-3 min-h-[4.5rem]' : '' }}" itemprop="reviewBody">
            {{ $text }}
        </p>
    </div>

    @if ($meta)
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
            {{ $meta }}
        </span>
    @endif

    {{-- MODAL --}}
    <div x-show="modal" x-cloak x-transition.opacity
        class="fixed inset-0 z-[110] bg-black/60 flex items-center justify-center p-4" @click.self="modal = false">
        <button type="button"
            class="absolute right-6 top-6 z-[120] flex h-12 w-12 items-center justify-center rounded-full bg-white/90 text-3xl text-gray-800 shadow hover:bg-white"
            @click="modal = false" aria-label="Закрыть">×</button>

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 md:p-8">
            <div class="flex items-start gap-3 mb-4">
                <div
                    class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-800 flex items-center justify-center overflow-hidden shrink-0">
                    @if ($avatar)
                        <img src="{{ $avatar }}" alt="{{ $name }}" class="w-full h-full object-cover">
                    @else
                        <span class="font-semibold">{{ mb_substr($name, 0, 1) }}</span>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-900">{{ $name }}</p>
                    @if ($city)
                        <p class="text-sm text-gray-500">{{ $city }}</p>
                    @endif
                </div>
                @if ($dateLabel)
                    <span class="text-xs text-gray-500">{{ $dateLabel }}</span>
                @endif
            </div>
            <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                {{ $text }}
            </div>
        </div>
    </div>

</article>
