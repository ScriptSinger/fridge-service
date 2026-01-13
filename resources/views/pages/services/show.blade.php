<x-layouts.app>
    <x-ui.breadcrumbs :model="$service" route="services.show" />
    <x-sections.service.hero :service="$service" />
    <x-sections.service.brands :brands="$brands" :service="$service" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.home.contact />
    <x-ui.scroll-up />
</x-layouts.app>
