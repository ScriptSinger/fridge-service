<div class="divide-y">
    @foreach ($services as $service)
        @php $price = $service->preferredPrice($service->device_id); @endphp

        <div class="py-3">
            <div class="font-medium">{{ $service->name }}</div>
            <div class="text-sm mt-1 whitespace-nowrap">
                @if ($price && $price->price_from)
                    от {{ number_format($price->price_from, 0, '.', ' ') }} {{ $price->units ?? '₽' }}
                @else
                    по договорённости
                @endif
            </div>
        </div>
    @endforeach
</div>
