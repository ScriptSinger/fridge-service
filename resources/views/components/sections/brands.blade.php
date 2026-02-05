<x-ui.sections.wrapper>
    <x-ui.sections.header
        title="Бренды
            {{ Str::lower($device->typeInCase('genitive')) }},
            которые мы ремонтируем"
        subtitle="Работаем с большинством популярных марок. Ремонтируем бытовые и
            коммерческие {{ Str::lower($device->typeInCase('accusative')) }}." />

    <div class="flex flex-wrap -m-4 px-5 md:px-0">
        @foreach ($models as $model)
            @continue(!$model->slug)
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full shadow-sm hover:shadow-lg transition">
                <a href="{{ route('devices.brands.show', [$device->slug, $model->slug]) }}"
                    class="block relative h-48 rounded overflow-hidden">
                    <img alt="{{ $model->name }}" aria-label="Перейти на страницу бренда {{ $model->name }}"
                        class="object-contain object-center w-full h-full block cursor-pointer"
                        src="{{ asset('storage/' . $model->image) }}">
                </a>
            </div>
        @endforeach
    </div>
</x-ui.sections.wrapper>
