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
                    <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transform transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
