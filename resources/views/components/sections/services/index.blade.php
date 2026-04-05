<x-ui.sections.wrapper id="pricing">

    <x-ui.sections.header title="Примерные цены на ремонт бытовой техники"
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
