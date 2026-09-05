@props([
    'model',
    'h1',
    'subtitle',
    'compact' => false,
    'image' => null,
    'imageAlt' => 'Мастер по ремонту бытовой техники в Уфе',
    'zoomable' => false,
])

<section x-data="modalPhone()" class="text-gray-600 body-font">

    <div @class([
        'container mx-auto flex lg:flex-row flex-col lg:items-center px-5',
        'py-10 md:py-24 md:pt-9' => ! $compact,
        'py-8 md:py-12' => $compact,
    ])>
        <div class="lg:max-w-lg lg:w-full mb-10 lg:mb-0">
            @if ($zoomable)
                <a href="{{ $image ?? asset('assets/images/hero.webp') }}" @click.prevent="$dispatch('hero-image-zoom')"
                    x-data="{ imgLoaded: false }" x-init="if ($refs.heroImg.complete) imgLoaded = true"
                    class="block relative w-full cursor-zoom-in">
                    <div x-show="!imgLoaded" class="absolute inset-0 aspect-[7/4] rounded bg-gray-200 animate-pulse"></div>
                    <img x-ref="heroImg" class="w-full aspect-[7/4] object-cover object-center rounded"
                        src="{{ $image ?? asset('assets/images/hero.webp') }}" alt="{{ $imageAlt }}"
                        fetchpriority="high" decoding="async" @load="imgLoaded = true" @@error="imgLoaded = true"
                        :class="imgLoaded ? 'opacity-100' : 'opacity-0'">
                </a>
            @else
                <div x-data="{ imgLoaded: false }" x-init="if ($refs.heroImg.complete) imgLoaded = true"
                    class="relative w-full">
                    <div x-show="!imgLoaded" class="absolute inset-0 aspect-[7/4] rounded bg-gray-200 animate-pulse"></div>
                    <img x-ref="heroImg" class="w-full aspect-[7/4] object-cover object-center rounded"
                        src="{{ $image ?? asset('assets/images/hero.webp') }}" alt="{{ $imageAlt }}"
                        fetchpriority="high" decoding="async" @load="imgLoaded = true" @@error="imgLoaded = true"
                        :class="imgLoaded ? 'opacity-100' : 'opacity-0'">
                </div>
            @endif
        </div>
        <div class="lg:flex-grow lg:pl-24 flex flex-col md:text-left text-center">
            <h1 class="md:text-left title-font text-2xl sm:text-3xl lg:text-4xl mb-4 font-medium text-gray-900">
                {{ $model?->h1 ?? $h1 }}
            </h1>
            <p class="mb-8 leading-relaxed ">{{ $model?->subtitle ?? $subtitle }} </p>
            <div class="flex justify-center md:justify-start ">
                <button @click="openModal()"
                    class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer">Заказать
                    ремонт</button>
            </div>
        </div>
    </div>
    <x-ui.modal-phone x-ref="modal" :model="$model" />
</section>
