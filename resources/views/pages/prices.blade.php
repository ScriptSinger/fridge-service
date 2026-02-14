<x-layouts.app :title="'Цены на ремонт бытовой техники'" :description="'Примерные цены на ремонт по типам техники. Точная стоимость определяется после диагностики.'">
    <x-ui.breadcrumbs route="prices.index" :model="null" />
    <x-sections.hero :model="null" h1="Стоимость услуг по ремонту"
        subtitle="Цены сгруппированы по типам техники. Точная стоимость определяется после диагностики."
        containerClass="pt-9" />



    <x-sections.prices.index :devices="$devices" />
    <x-sections.common.benefits :devices="$devices" />


    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
