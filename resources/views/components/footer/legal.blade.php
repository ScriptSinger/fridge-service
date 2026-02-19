<div class="bg-gray-100">
    <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
        <p class="text-gray-500 text-sm text-center sm:text-left">© {{ date('Y') }} РемБытТехника — Все права
            защищены.
        </p>
        <p class="text-gray-500 text-sm text-center sm:text-left sm:ml-4">
            Содержимое сайта не является публичной офертой.
        </p>
        <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
            <a href="{{ route('legal.privacy-policy') }}"
                class="text-sm text-gray-500 hover:text-gray-700 transition-colors">
                Политика конфиденциальности
            </a>
            <span class="mx-2 text-gray-400">|</span>
            <a href="{{ route('legal.personal-data-consent') }}"
                class="text-sm text-gray-500 hover:text-gray-700 transition-colors">
                Согласие на обработку ПДн
            </a>
        </span>
    </div>
</div>
