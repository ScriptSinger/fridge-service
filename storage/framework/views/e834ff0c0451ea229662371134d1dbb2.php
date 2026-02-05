<button x-data="{ show: false }" x-cloak x-show="show" style="display: none;" x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    x-init="window.addEventListener('scroll', () => { show = window.scrollY > 300 })"
    class="fixed bottom-20 right-4 p-4 bg-yellow-500 text-white rounded-full shadow-lg hover:bg-yellow-600 hover:scale-110 transition transform duration-300 cursor-pointer"
    aria-label="Scroll to top">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
    </svg>
</button>
<?php /**PATH /var/www/html/resources/views/components/ui/scroll-up.blade.php ENDPATH**/ ?>