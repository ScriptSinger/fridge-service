<x-ui.sections.wrapper id="services">
    <x-ui.sections.header title="Что нужно ремонтировать?" subtitle="Выберите тип вашей техники" />
    <div class="flex flex-wrap -m-4 ">
        @foreach ($services as $service)
            @continue(!$service->slug)
            <div class="w-full md:w-full lg:w-1/2 sm:w-1/2 p-4 ">
                <div class="flex relative cursor-pointer">

                    <a href="{{ route('services.show', $service->slug) }}"
                        class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative block">
                        @if ($service->image)
                            <img alt="gallery"
                                class="w-full object-cover h-full object-center block opacity-25 hover:opacity-60 transition-opacity duration-300 absolute inset-0"
                                src="{{ $service->image_url }}">
                        @endif

                        <div class="text-center relative z-10 w-full">
                            <h3 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">
                                {{ $service->type }}
                            </h3>
                        </div>
                    </a>

                </div>
            </div>
        @endforeach
    </div>
</x-ui.sections.wrapper>
