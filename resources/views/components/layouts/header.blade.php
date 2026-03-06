<header class="text-gray-600 body-font sticky top-0 inset-x-0 z-50 bg-white shadow md:static md:shadow-none"
    x-data="{ open: false }"
    @keydown.escape.window="open = false">
    <div class="container mx-auto flex items-center justify-between p-4 md:p-5">
        <x-ui.logo />
        <button type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded text-gray-700 hover:text-gray-900"
            aria-label="Открыть меню" @click="open = !open">
            <x-heroicon-o-bars-3 x-show="!open" class="h-6 w-6" />
            <x-heroicon-o-x-mark x-show="open" class="h-6 w-6" />
        </button>
        <x-ui.nav variant="header" />
        <x-ui.phone-cta variant="header" />
    </div>
    <x-ui.nav variant="mobile" />
</header>
