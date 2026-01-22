<div x-data='leadForm(@json($payload))' {{ $attributes->merge(['class' => 'w-full']) }}>
    <template x-if="!success">
        <div>
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Заказать ремонт</h2>
            <p class="leading-relaxed mb-5 text-gray-600">Заполните форму, и мы свяжемся с вами в ближайшее время.</p>
            <div class="relative mb-4">
                <label for="name" class="leading-7 text-sm text-gray-600">Имя</label>
                <input type="text" x-model="form.name" name="name"
                    class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <p x-show="errors.name" x-text="errors.name"></p>
            </div>

            <div class="relative mb-4">
                <label for="phone" class="leading-7 text-sm text-gray-600">Телефон</label>
                <input type="text" x-model="form.phone" x-phone type="text" name="phone"
                    class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <p x-show="errors.phone" x-text="errors.phone"></p>
            </div>

            <button @click="submit()" :disabled="loading"
                class="text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer w-full">
                <span x-show="!loading">Отправить</span>
                <span x-show="loading">Отправляем...</span>
            </button>
        </div>
    </template>

    <template x-if="success">
        <p class="text-grey-600 font-medium text-center">Спасибо! Заявка отправлена.</p>
    </template>
</div>
