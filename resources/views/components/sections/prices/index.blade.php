@props(['devices'])

@php
    $pluralizeRu = function (int $n, string $one, string $few, string $many) {
        $mod100 = abs($n) % 100;
        $mod10 = $mod100 % 10;

        if ($mod100 >= 11 && $mod100 <= 14) {
            return $many;
        }

        return match (true) {
            $mod10 === 1 => $one,
            $mod10 >= 2 && $mod10 <= 4 => $few,
            default => $many,
        };
    };
@endphp

<x-ui.sections.wrapper id="pricing">
    <x-ui.sections.header title="Примерные цены на ремонт бытовой техники"
        subtitle="Выберите тип техники, чтобы посмотреть полный список услуг и цен" />

    <div class="grid gap-4 sm:grid-cols-2">
        @foreach ($devices as $device)
            @php
                $minPrice = $device->services
                    ->map(fn ($service) => $service->preferredPrice($service->device_id)?->price_from)
                    ->filter()
                    ->min();
                $servicesCount = $device->services->count();
                $servicesWord = $pluralizeRu($servicesCount, 'вид', 'вида', 'видов');
            @endphp

            <div class="rounded-lg border border-gray-200 bg-white p-5 flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900 text-lg">{{ $device->type }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $servicesCount }} {{ $servicesWord }} ремонта</p>
                </div>

                <div class="mt-4 flex items-center justify-between gap-4">
                    <span class="text-gray-900 font-medium whitespace-nowrap">
                        @if ($minPrice)
                            от {{ number_format($minPrice, 0, '.', ' ') }} ₽
                        @else
                            по договорённости
                        @endif
                    </span>

                    <a href="{{ route('devices.show', $device) }}#pricing"
                        class="font-medium text-yellow-600 hover:text-yellow-700 hover:underline whitespace-nowrap">
                        Смотреть цены →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-ui.sections.wrapper>
