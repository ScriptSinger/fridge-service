@props(['reviews'])

<x-ui.sections.wrapper class="text-gray-700">
    <div class="-my-8 divide-y-2 divide-gray-100">
        @foreach ($reviews as $review)
            @php
                $meta = collect([$review->device?->type, $review->brand?->name, $review->service?->name])
                    ->filter()
                    ->implode(' • ');
                $source = $review->source ?? 'google';
            @endphp

            <div class="py-8 flex flex-wrap md:flex-nowrap items-stretch">
                <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col h-full">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-800 flex items-center justify-center overflow-hidden">
                            @if ($review->avatar)
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk(config('filesystems.media'))->url($review->avatar) }}"
                                    alt="{{ $review->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-semibold">{{ mb_substr($review->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <span
                                class="font-semibold title-font text-gray-700 block truncate">{{ $review->name }}</span>
                            @if ($review->city)
                                <span class="text-sm text-gray-500 block truncate">{{ $review->city }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="md:flex-grow h-full flex flex-col">
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            @if ($source !== 'yandex')
                                <img src="{{ asset('assets/images/svg') }}/{{ $source }}.svg"
                                    alt="{{ $source }}" class="h-6 w-6"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/svg/google.svg') }}';">
                            @endif
                            @if ($review->rating)
                                <div class="flex items-center gap-2 text-yellow-500">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg viewBox="0 0 24 24"
                                                class="w-5 h-5 {{ $i > $review->rating ? 'opacity-30' : '' }}"
                                                fill="currentColor">
                                                <path
                                                    d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ number_format($review->rating, 1) }}/5
                                    </span>
                                </div>
                            @endif
                        </div>
                        @if ($review->created_at)
                            <span class="text-sm text-gray-500">{{ $review->created_at->format('d.m.Y') }}</span>
                        @endif
                    </div>
                    <p class="leading-relaxed whitespace-pre-line text-gray-700">
                        {{ $review->text }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-ui.sections.wrapper>
