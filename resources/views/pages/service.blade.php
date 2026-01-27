<x-layouts.app :title="$service->title" :description="$service->description">
    <x-ui.breadcrumbs :model="$service" route="services.show" />
    <x-sections.hero :model="$service" :h1="$service->h1" :subtitle="$service->subtitle" containerClass="pt-9" />
    <x-sections.common.problems :problems="$problems" :service="$service" />
    <x-sections.brands :models="$brands" :service="$service" />
    <x-sections.common.steps />
    <x-sections.common.pricing />
    <x-sections.contact :model="$service" />
    <x-ui.scroll-up />
</x-layouts.app>
