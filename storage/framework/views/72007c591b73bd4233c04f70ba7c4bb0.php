<div x-show="open" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-full max-w-md relative">

        <button @click="closeModal()"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-900
            cursor-pointer">✕</button>
        <h2 class="text-xl font-bold mb-4">Заказать ремонт</h2>
        <form @submit.prevent="submit()" class="flex flex-col gap-4">

            <input type="tel" x-ref="phone" placeholder="+7 (___) ___-__-__"
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button type="submit"
                class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 cursor-pointer">Отправить</button>
        </form>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/ui/modal-phone.blade.php ENDPATH**/ ?>