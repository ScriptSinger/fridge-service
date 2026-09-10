<x-ui.sections.wrapper id="contact" class="relative">
    <div class="flex sm:flex-nowrap flex-wrap">
        <div
            class="w-full lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 relative h-64 sm:h-auto"
            x-data="yandexMap(@js(['lat' => 54.769579, 'lng' => 56.010745, 'apikey' => config('services.yandex.maps_api_key')]))">

            <div x-ref="map" class="absolute inset-0 w-full h-full"></div>

            <div x-show="open" x-cloak style="position:absolute;top:12px;left:12px;z-index:10;max-width:calc(100% - 24px);">
                <x-sections.contact-map-card />
            </div>
        </div>

        <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
            <x-forms.leads class="w-full" :model="$model" idPrefix="contact" title="Получить консультацию"
               subtitle="Оставьте контакты, и мы бесплатно проконсультируем вас в ближайшее время." />
        </div>
    </div>
</x-ui.sections.wrapper>
