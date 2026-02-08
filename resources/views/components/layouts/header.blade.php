<header class="text-gray-600 body-font sticky top-0 inset-x-0 z-50 bg-white shadow md:static md:shadow-none"
    x-data="{ open: false }"
    @keydown.escape.window="open = false">
    <div class="container mx-auto flex items-center justify-between p-4 md:p-5">
        <x-ui.logo />
        <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded text-gray-700 hover:text-gray-900"
            aria-label="Открыть меню" @click="open = !open">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <x-ui.nav variant="header" />
        <x-ui.phone-cta variant="header" />
    </div>
    <x-ui.nav variant="mobile" />
</header>
