<x-ui.sections.wrapper>
    <x-ui.sections.header
        title="Бренды
            {{ Str::lower($device->typeInCase('genitive')) }},
            которые мы ремонтируем"
        subtitle="Работаем с большинством популярных марок. Ремонтируем бытовые и
            коммерческие {{ Str::lower($device->typeInCase('accusative')) }}." />

    @php($visibleModels = $models->filter(fn($model) => !empty($model->slug))->values())

    <x-ui.sections.toggle-list :limit="8" :count="$visibleModels->count()" toggleSpacingClass="mt-8">
        <div class="flex flex-wrap -m-4 px-5 md:px-0">
            @foreach ($visibleModels as $index => $model)
                <div class="lg:w-1/4 md:w-1/2 p-4 w-full shadow-sm hover:shadow-lg transition"
                    x-show="showAll || {{ $index }} < limit" x-cloak>
                    <a href="{{ route('devices.brands.show', [$device->slug, $model->slug]) }}"
                        class="block relative h-48 rounded overflow-hidden">
                        <img alt="{{ $model->name }}" aria-label="Перейти на страницу бренда {{ $model->name }}"
                            class="object-contain object-center w-full h-full block cursor-pointer"
                            src="{{ asset('storage/' . $model->image) }}">
                    </a>
                </div>
            @endforeach
        </div>
    </x-ui.sections.toggle-list>
</x-ui.sections.wrapper>
