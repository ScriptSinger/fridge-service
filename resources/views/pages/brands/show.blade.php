<x-layouts.app :title="$service->title" :description="$service->description">
    <x-ui.breadcrumbs :model="$brand" route="services.brands.show" />
    <x-sections.brands.hero :service="$service" :brand="$brand" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.home.contact />
    <x-ui.scroll-up />
</x-layouts.app>
