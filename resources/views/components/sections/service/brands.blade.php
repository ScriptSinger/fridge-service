<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col   w-full mb-12">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"> Бренды
                {{ Str::lower($service->typeInCase('genitive')) }},
                которые мы ремонтируем</h2>
            <p class="lg:w-2/3 leading-relaxed text-base">Работаем с большинством популярных марок. Ремонтируем бытовые и
                коммерческие {{ Str::lower($service->typeInCase('accusative')) }}.</p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($brands as $brand)
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full shadow-sm hover:shadow-lg transition">
                    <a class="block relative h-48 rounded overflow-hidden">
                        <img alt="{{ $brand->name }}" aria-label="Перейти на страницу бренда {{ $brand->name }}"
                            class="object-contain object-center w-full h-full block cursor-pointer"
                            src="{{ asset('storage/' . $brand->image) }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
