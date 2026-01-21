<form x-data="leadForm(<?php echo json_encode($payload, 15, 512) ?>)" @submit.prevent="submit" class="w-full">
    <div class="mb-4">
        <label class="leading-7 text-sm text-gray-600">Имя</label>
        <input type="text" x-model="form.name"
            class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <template x-if="errors.name">
            <p class="text-red-500 text-xs mt-1" x-text="errors.name[0]"></p>
        </template>
    </div>

    <div class="mb-4">
        <label class="leading-7 text-sm text-gray-600">Телефон</label>
        <input type="text" x-model="form.phone"
            class="w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <template x-if="errors.phone">
            <p class="text-red-500 text-xs mt-1" x-text="errors.phone[0]"></p>
        </template>
    </div>

    

    <button type="submit"
        class="text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer">
        <template x-if="loading">Отправка...</template>
        <template x-if="!loading">Отправить</template>
    </button>

    <p class="text-xs text-gray-500 mt-3" x-show="success">Заявка отправлена! Мы свяжемся с вами.</p>
</form>
<?php /**PATH /var/www/html/resources/views/components/lead-form.blade.php ENDPATH**/ ?>