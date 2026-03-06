<button x-data="{ show: false }" x-cloak x-show="show" style="display: none;" x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 300 })"
    class="fixed bottom-20 right-4 p-4 bg-yellow-500 text-white rounded-full shadow-lg hover:bg-yellow-600 hover:scale-110 transition transform duration-300 cursor-pointer"
    aria-label="Scroll to top">
    <x-heroicon-o-chevron-up class="h-5 w-5" />
</button>
