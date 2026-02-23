@props(['device', 'brands'])

@php
    $items = $brands->filter(fn($brand) => !empty($brand->slug))->values()->map(
        fn($brand) => [
            'name' => $brand->name,
            'url' => route('devices.brands.show', [$device->slug, $brand->slug]),
        ],
    );
@endphp

<x-ui.sections.wrapper id="brand-select">
    <x-ui.sections.header title="Выберите бренд {{ Str::lower($device->typeInCase('genitive')) }}"
        subtitle="Начните вводить название бренда или выберите из списка." />

    <div class="mx-auto mt-6">
        <div x-data="brandSelect(@js($items))" class="space-y-4">

            <!-- Input -->
            <div class="rounded-lg bg-gray-100">
                <input type="text" x-model="search" @focus="open = true" @click.away="open = false"
                    @keydown.enter.prevent="goToFirst()" placeholder="Введите бренд..."
                    class="w-full p-4 bg-gray-100 rounded-lg focus:outline-none text-gray-900 placeholder-gray-500">
            </div>

            <!-- Dropdown -->
            <div x-show="open" x-transition class="bg-white rounded-lg shadow-sm overflow-hidden">
                <template x-if="filtered.length > 0">
                    <div class="max-h-64 overflow-y-auto">
                        <template x-for="brand in filtered" :key="brand.url">
                            <a :href="brand.url" class="block p-4 hover:bg-gray-50 transition text-gray-900"
                                x-text="brand.name"></a>
                        </template>
                    </div>
                </template>

                <div x-show="filtered.length === 0" class="p-4 text-gray-500">
                    Ничего не найдено
                </div>
            </div>

        </div>
    </div>
</x-ui.sections.wrapper>
