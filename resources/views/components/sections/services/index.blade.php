<x-ui.sections.wrapper id="pricing">
    @php
        $title = isset($device)
            ? 'Примерные цены на ремонт ' . $device->typeInCase('genitive_plural')
            : 'Примерные цены на ремонт бытовой техники';

        if (isset($brand)) {
            $title .= ' ' . $brand->name;
        }
    @endphp

    <x-ui.sections.header :title="$title"
        subtitle="Точная стоимость определяется после диагностики" />

    <div class="hidden md:block">
        @include('components.sections.services.table', [
            'services' => $services,
            'brand' => $brand ?? null,
        ])
    </div>

    <div class="md:hidden">
        @include('components.sections.services.mobile', [
            'services' => $services,
            'brand' => $brand ?? null,
        ])
    </div>

</x-ui.sections.wrapper>
