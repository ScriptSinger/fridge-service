<h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Контакты</h2>
<address class="not-italic mb-10 text-gray-600">
    <p class="text-gray-600 hover:text-gray-800">город {{ config('contacts.address_city') }}</p>
    <p class="text-gray-600 hover:text-gray-800">
        <x-ui.phone
            class="inline-flex items-center bg-yellow-500 text-white border-0 py-2 px-4 rounded text-base hover:bg-yellow-600 focus:outline-none mt-4 md:mt-0" />
    </p>
    <p class="text-gray-600 hover:text-gray-800">{{ config('contacts.opening_hours_display') }}</p>
</address>
