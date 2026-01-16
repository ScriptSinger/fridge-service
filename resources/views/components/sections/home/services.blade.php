<section id="services" class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col   w-full mb-12">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Что нужно ремонтировать?</h2>
            <p class="lg:w-2/3 leading-relaxed text-base">Выберите тип вашей техники</p>
        </div>
        <div class="flex flex-wrap -m-4 ">
            @foreach ($services as $service)
                <div class="w-full md:w-full lg:w-1/2 sm:w-1/2 p-4 ">
                    <div class="flex relative cursor-pointer">

                        <a href="{{ route('services.show', $service->slug) }}"
                            class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative block">
                            @if ($service->image)
                                <img alt="gallery"
                                    class="w-full object-cover h-full object-center block opacity-25 hover:opacity-60 transition-opacity duration-300 absolute inset-0"
                                    src="{{ Storage::url($service->image) }}">
                            @endif

                            <div class="text-center relative z-10 w-full">
                                <h3 class="text-xl text-gray-900 font-medium title-font mb-2">{{ $service->type }}

                                </h3>
                            </div>

                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
