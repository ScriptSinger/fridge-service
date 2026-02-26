<x-ui.sections.wrapper id="contacts-info">
    <x-ui.sections.header title="Контактная информация" subtitle="Телефон, email, график работы и зона выезда." />

    <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg viewBox="0 0 24 24" class="w-12 h-12 mb-3 inline-block text-yellow-500" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="6" y="2.5" width="12" height="19" rx="3"></rect>
                    <line x1="11" y1="18" x2="13" y2="18"></line>
                </svg>
                <p class="text-sm text-gray-500">Телефон</p>
                <div class="mt-1">
                    <x-ui.phone class="justify-center text-gray-900 hover:text-yellow-600" />
                </div>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg viewBox="0 0 24 24" class="w-12 h-12 mb-3 inline-block text-yellow-500" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="M4.5 7.5 12 12.5 19.5 7.5" />
                </svg>
                <p class="text-sm text-gray-500">Email</p>
                <a href="mailto:{{ config('contacts.email') }}"
                    class="leading-relaxed text-gray-900 mt-1 inline-block break-all hover:text-yellow-600">
                    {{ config('contacts.email') }}
                </a>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg viewBox="0 0 24 24" class="w-12 h-12 mb-3 inline-block text-yellow-500" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 7v5l3 2" />
                </svg>
                <p class="text-sm text-gray-500">График работы</p>
                <p class="leading-relaxed text-gray-900 mt-1">{{ config('contacts.opening_hours_display') }}</p>
            </div>
        </div>

        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
            <div class="border-2 border-gray-200 px-4 py-6 rounded-lg h-full">
                <svg viewBox="0 0 24 24" class="w-12 h-12 mb-3 inline-block text-yellow-500" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 21.5s8-4.5 8-10.5a8 8 0 1 0-16 0c0 6 8 10.5 8 10.5Z" />
                    <circle cx="12" cy="11.5" r="3" />
                </svg>
                <p class="text-sm text-gray-500">Зона выезда</p>
                <p class="leading-relaxed text-gray-900 mt-1">{{ config('contacts.area_served') }}</p>
            </div>
        </div>
    </div>
</x-ui.sections.wrapper>
