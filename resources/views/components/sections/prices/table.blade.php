<div class="w-full overflow-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-3 bg-gray-100">Услуга</th>
                <th class="px-4 py-3 bg-gray-100">Цена от</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($services as $service)
                @php $price = $service->preferredPrice($service->device_id); @endphp

                <tr>
                    <td class="border-b-2 border-gray-200 px-4 py-3 whitespace-nowrap">
                        {{ $service->name }}
                    </td>
                    <td class="border-b-2 border-gray-200 px-4 py-3">
                        @if ($price && $price->price_from)
                            от {{ number_format($price->price_from, 0, '.', ' ') }} {{ $price->units ?? '₽' }}
                        @else
                            по договорённости
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
