@props(['slides'])

{{-- Cards are rendered server-side so crawlers see the images and links to gallery pages --}}
@foreach ($slides as $index => $slide)
    <article
        class="relative shrink-0 border-r border-gray-200 last:border-r-0 cursor-zoom-in basis-full md:basis-1/2 lg:basis-1/3"
        data-card @click="openFullscreen({{ $index }})">

        {{-- The slider sits far below the fold — never let it compete with the hero for bandwidth --}}
        <img src="{{ $slide['image'] }}" alt="{{ $slide['image_alt'] }}" loading="lazy"
            decoding="async" width="1200" height="800"
            class="h-64 w-full object-cover object-center md:h-72 lg:h-80">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-3 md:p-6 lg:p-8 text-white">

            <h3 class="text-yellow-400 mb-1 text-sm font-semibold md:text-base lg:text-lg line-clamp-2">
                @if ($slide['url'])
                    <a href="{{ $slide['url'] }}" class="cursor-pointer hover:underline" @click.stop>{{ $slide['title'] }}</a>
                @else
                    {{ $slide['title'] }}
                @endif
            </h3>
        </div>
    </article>
@endforeach
