@props(['items', 'showYear' => false, 'image' => null, 'imageAlt' => ''])

<div class="flex flex-wrap w-full">

    <div class="lg:w-2/5 md:w-1/2 md:pr-10 md:py-6">

        @foreach ($items as $item)
            <div class="flex relative {{ !$loop->last ? 'pb-12' : '' }}">

                @if (!$loop->last)
                    <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                @endif
                <div
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10 shadow-sm">
                    @if (isset($item['icon']))
                        <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5" />
                    @elseif($showYear && isset($item['year']))
                        <span
                            class="text-xs font-semibold">{{ is_numeric($item['year']) ? substr($item['year'], -2) : '•' }}</span>
                    @endif
                </div>

                <div class="flex-grow pl-4">
                    <h3 class="font-semibold text-gray-900 mb-1">
                        @if ($showYear && isset($item['year']))
                            <span>{{ $item['year'] }}</span> —
                        @endif
                        {{ $item['title'] }}
                    </h3>
                    <p class="leading-relaxed text-gray-600 text-sm">
                        {{ $item['description'] }}
                    </p>
                </div>

            </div>
        @endforeach

    </div>

    @if ($image)
        <img class="lg:w-3/5 md:w-1/2 object-cover object-center rounded-lg md:mt-0 mt-12" src="{{ $image }}"
            alt="{{ $imageAlt }}">
    @endif

</div>
