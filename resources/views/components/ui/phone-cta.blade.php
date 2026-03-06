@props(['variant' => 'header'])

@if ($variant === 'fab')
    <a href="tel:{{ config('contacts.phone_tel') }}"
        class="fixed bottom-4 right-4 p-4 bg-yellow-500 text-white rounded-full shadow-lg hover:bg-yellow-600 hover:scale-110 transition transform duration-300 cursor-pointer md:hidden"
        aria-label="Позвонить">
        <x-heroicon-o-phone class="h-5 w-5" />
    </a>
@else
    <a href="tel:{{ config('contacts.phone_tel') }}"
        class="hidden md:inline-flex items-center bg-yellow-500 text-white border-0 py-2 px-4 rounded text-base hover:bg-yellow-600 focus:outline-none">
        <span class="font-semibold"> {{ config('contacts.phone_display') }}</span>
    </a>
@endif
