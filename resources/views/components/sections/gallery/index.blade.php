@props(['galleries'])

@php
    $total = $galleries->count();
    $brandOptions = ['all' => 'Все бренды'];
    foreach ($galleries->pluck('brand.name')->filter()->unique()->values() as $brandName) {
        $brandOptions[strtolower((string) $brandName)] = (string) $brandName;
    }

    $deviceOptions = ['all' => 'Вся техника'];
    foreach ($galleries->pluck('device.type')->filter()->unique()->values() as $deviceType) {
        $deviceOptions[strtolower((string) $deviceType)] = (string) $deviceType;
    }

    $activeBrand = strtolower((string) request('brand', 'all'));
    $activeDevice = strtolower((string) request('device', 'all'));
@endphp

<x-ui.sections.wrapper class="bg-gray-50">
    <x-ui.sections.header suptitle="Галерея работ" title="Реальные кейсы"
        subtitle="На странице {{ $total }} фото выполненных ремонтов">
    </x-ui.sections.header>

    <div x-data="galleryIndexSort(@js(request('sort', 'newest')), @js($activeBrand), @js($activeDevice))" x-init="init()">
        <div class="mb-8 flex flex-wrap justify-end gap-3">
            <x-ui.buttons.filter :value="$activeBrand" :options="$brandOptions" :event-name="'gallery-brand-change'" :client-sort="true" />
            <x-ui.buttons.filter :value="$activeDevice" :options="$deviceOptions" :event-name="'gallery-device-change'" :client-sort="true" />
            <x-ui.buttons.filter :value="request('sort', 'newest')" :options="[
                'newest' => 'Сначала новые',
                'oldest' => 'Сначала старые',
            ]" :event-name="'gallery-sort-change'" :client-sort="true" />
        </div>

        <div x-ref="grid" class="columns-1 md:columns-2 xl:columns-3 gap-8 space-y-8">
            @foreach ($galleries as $gallery)
                <div class="break-inside-avoid" data-created-ts="{{ $gallery->created_at?->timestamp ?? 0 }}"
                    data-brand="{{ strtolower((string) ($gallery->brand?->name ?? '')) }}"
                    data-device="{{ strtolower((string) ($gallery->device?->type ?? '')) }}">
                    <x-sections.gallery.gallery-card :gallery="$gallery" />
                </div>
            @endforeach
        </div>
    </div>
</x-ui.sections.wrapper>
