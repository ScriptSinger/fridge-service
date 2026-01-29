<div x-data="{ showAll: false }" class="w-full overflow-auto">

    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-3 bg-gray-100">Услуга</th>
                {{-- <th class="px-4 py-3 bg-gray-100">Описание</th> --}}
                <th class="px-4 py-3 bg-gray-100">Цена от</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $index => $service)
                @php
                    $price = $service->prices->first();
                @endphp
                <tr x-show="showAll || {{ $index }} < 6" x-cloak>
                    <td class="border-b-2 border-gray-200 px-4 py-3"> {{ $service->name }}</td>
                    {{-- <td class="border-b-2 border-gray-200 px-4 py-3">{{ $service->description ?? '—' }}</td> --}}
                    <td class="border-b-2 border-gray-200 px-4 py-3">
                        @if ($price && $price->price_from)
                            от {{ number_format($price->price_from, 0, '.', ' ') }} {{ $price->units }}
                        @else
                            по договорённости
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (count($services) > 6)
        <div class="flex pl-4 mt-4 w-full mx-auto">
            <a @click.prevent="showAll = !showAll" class="text-yellow-500 inline-flex items-center cursor-pointer">
                <span x-show="!showAll">Узнать больше</span>
                <span x-show="showAll">Свернуть</span>

                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }"
                    viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif
</div>
