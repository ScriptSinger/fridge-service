@props(['variant' => 'header'])

@if ($variant === 'fab')
    <a href="tel:{{ config('contacts.phone_tel') }}"
        class="fixed bottom-4 right-3 p-4 bg-yellow-500 text-white rounded-full shadow-lg hover:bg-yellow-600 hover:scale-110 transition transform duration-300 cursor-pointer md:hidden"
        aria-label="Позвонить">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 5.5C3 4.12 4.12 3 5.5 3h1.3c.7 0 1.3.49 1.45 1.18l.74 3.3a1.5 1.5 0 0 1-.44 1.42l-1.5 1.5a16 16 0 0 0 6.73 6.73l1.5-1.5a1.5 1.5 0 0 1 1.42-.44l3.3.74c.69.15 1.18.75 1.18 1.45v1.3A2.5 2.5 0 0 1 19.5 22C10.39 22 3 14.61 3 5.5Z" />
        </svg>
    </a>
@else
    <a href="tel:{{ config('contacts.phone_tel') }}"
        class="hidden md:inline-flex items-center bg-yellow-500 text-white border-0 py-2 px-4 rounded text-base hover:bg-yellow-600 focus:outline-none">
        <span class="font-semibold"> {{ config('contacts.phone_display') }}</span>
    </a>
@endif
