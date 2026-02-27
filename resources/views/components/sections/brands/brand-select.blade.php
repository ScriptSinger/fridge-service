@props(['device', 'brands'])

@php
    $items = collect($brands)->filter(fn($b) => !empty($b['slug']))->values()->map(
        fn($b) => [
            'name' => $b['name'],
            'name_ru' => $b['name_ru'],
            'url' => route('devices.brands.show', [$device->slug, $b['slug']]),
        ],
    );
@endphp

<x-ui.sections.wrapper id="brand-select">
    <x-ui.sections.header title="Выберите бренд {{ Str::lower($device->typeInCase('genitive')) }}"
        subtitle="Начните вводить название бренда или выберите из списка" />

    <div class="mx-auto mt-6">
        <div x-data="brandSelect(@js($items))" class="space-y-4 relative">

            <!-- Input -->
            <div class="relative">
                <input type="text" x-model="search" @focus="open = true" @click="open = true" @click.away="open = false"
                    @keydown.enter.prevent="goToFirst()" @keydown.escape="open = false" placeholder="Введите бренд..."
                    class="w-full p-4 pr-12 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-gray-900 placeholder-gray-500 cursor-pointer transition">

                <!-- Arrow -->
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.937a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Dropdown -->
            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute z-20 w-full bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">

                <template x-if="filtered.length > 0">
                    <div class="max-h-64 overflow-y-auto">
                        <template x-for="brand in filtered" :key="brand.url">
                            <a :href="brand.url" class="block px-4 py-3 hover:bg-gray-50 transition text-gray-900"
                                x-text="(/[а-яё]/i.test(search) && brand.name_ru) ? brand.name_ru : brand.name"></a>
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
