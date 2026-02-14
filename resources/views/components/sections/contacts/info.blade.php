<x-ui.sections.wrapper id="contacts-info">
    <x-ui.sections.header title="Контактная информация" subtitle="Телефон, адрес, режим работы и зона выезда." />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Телефон</h3>
            <div class="mt-2 text-gray-900">
                <x-ui.phone class="text-gray-900 hover:text-yellow-600" />
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Адрес</h3>
            <p class="mt-2 text-gray-900">{{ config('contacts.address_full') }}</p>
            <p class="text-gray-700">{{ config('contacts.address_city') }}</p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">График работы</h3>
            <p class="mt-2 text-gray-900">{{ config('contacts.opening_hours_display') }}</p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500">Зона выезда</h3>
            <p class="mt-2 text-gray-900">{{ config('contacts.area_served') }}</p>
        </div>
    </div>
</x-ui.sections.wrapper>
