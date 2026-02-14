<x-layouts.app :title="'Цены на ремонт бытовой техники'" :description="'Примерные цены на ремонт по типам техники. Точная стоимость определяется после диагностики.'">
    <x-ui.breadcrumbs route="prices.index" :model="null" />
    <x-sections.hero :model="null" h1="Стоимость услуг по ремонту"
        subtitle="Цены сгруппированы по типам техники. Точная стоимость определяется после диагностики."
        containerClass="pt-9" />

    <x-ui.sections.wrapper>
        <div class="max-w-3xl">
            <p class="text-gray-700 leading-relaxed">
                Ниже — ориентировочные цены на ремонт по типам техники. Итоговая стоимость зависит от
                модели, сложности неисправности и необходимости запчастей. Перед началом работ мастер
                проводит диагностику и согласует цену.
            </p>
            <ul class="mt-4 text-gray-700 list-disc pl-5">
                <li>Диагностика бесплатна при ремонте</li>
                <li>Цена фиксируется до начала работ</li>
                <li>Работаем с оригинальными и качественными аналогами запчастей</li>
            </ul>
        </div>
    </x-ui.sections.wrapper>

    @foreach ($devices as $device)
        <x-ui.sections.wrapper>
            <x-ui.sections.header :title="$device->permalink" :subtitle="$device->subtitle" />

            <div class="hidden md:block">
                @include('components.sections.common.services.table', [
                    'services' => $device->services,
                ])
            </div>

            <div class="md:hidden">
                @include('components.sections.common.services.mobile', [
                    'services' => $device->services,
                ])
            </div>
        </x-ui.sections.wrapper>
    @endforeach



    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
