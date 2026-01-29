<div x-data="{ showAll: false }" class="divide-y">
    @foreach ($services as $index => $service)
        @php $price = $service->prices->first(); @endphp

        <div class="py-3" x-show="showAll || {{ $index }} < 4">
            <div class="font-medium">{{ $service->name }}</div>
            <div class="text-sm text-gray-500">{{ $service->description }}</div>
            <div class="text-sm mt-1">
                {{ $price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ₽' : ' ' }}
            </div>
        </div>
    @endforeach

    @if ($services->count() > 4)
        <div class="flex   mt-4 w-full mx-auto">
            <a @click.prevent="showAll = !showAll" class="text-yellow-500 inline-flex items-center cursor-pointer">
                <span x-show="!showAll">Узнать больше</span>
                <span x-show="showAll">Скрыть</span>

                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }"
                    viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif
</div>
