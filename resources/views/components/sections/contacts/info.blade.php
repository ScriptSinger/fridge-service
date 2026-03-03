<x-ui.sections.wrapper id="contacts-info">
    <x-ui.sections.header title="Контактная информация" subtitle="Телефон, email, график работы и зона выезда." />

    <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <x-heroicon-o-device-phone-mobile class="w-12 h-12 mb-3 inline-block text-yellow-500" />
                <p class="text-sm text-gray-500">Телефон</p>
                <div class="mt-1">
                    <x-ui.phone class="justify-center text-gray-900 hover:text-yellow-600" />
                </div>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <x-heroicon-o-envelope class="w-12 h-12 mb-3 inline-block text-yellow-500" />
                <p class="text-sm text-gray-500">Email</p>
                <a href="mailto:{{ config('contacts.email') }}"
                    class="leading-relaxed text-gray-900 mt-1 inline-block break-all hover:text-yellow-600">
                    {{ config('contacts.email') }}
                </a>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <x-heroicon-o-clock class="w-12 h-12 mb-3 inline-block text-yellow-500" />
                <p class="text-sm text-gray-500">График работы</p>
                <p class="leading-relaxed text-gray-900 mt-1">{{ config('contacts.opening_hours_display') }}</p>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <x-heroicon-o-map class="w-12 h-12 mb-3 inline-block text-yellow-500" />
                <p class="text-sm text-gray-500">Зона выезда</p>
                <p class="leading-relaxed text-gray-900 mt-1">{{ config('contacts.area_served') }}</p>
            </div>
        </div>
    </div>
</x-ui.sections.wrapper>
