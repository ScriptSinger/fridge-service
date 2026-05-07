<button x-data="{ show: false }" x-cloak x-show="show" style="display: none;" x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 300 })"
    class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 flex h-14 w-14 items-center justify-center rounded-full bg-yellow-500 text-white shadow-xl ring-1 ring-black/5 transition duration-200 hover:scale-105 hover:bg-yellow-600 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-white cursor-pointer"
    aria-label="Scroll to top">
    <x-heroicon-o-chevron-up class="h-5 w-5" />
</button>
