<x-ui.sections.wrapper id="pricing">

    <x-ui.sections.header title="Примерные цены на ремонт бытовой техники"
        subtitle="Точная стоимость определяется после диагностики" />

    <div class="hidden md:block">
        @include('components.sections.common.services.table', [
            'services' => $services,
        ])
    </div>

    <div class="md:hidden">
        @include('components.sections.common.services.mobile', [
            'services' => $services,
        ])
    </div>

</x-ui.sections.wrapper>
