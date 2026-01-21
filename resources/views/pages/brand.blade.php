<x-layouts.app :title="$service->title" :description="$service->description">
    <x-ui.breadcrumbs :model="$brand" route="services.brands.show" />
    <x-sections.hero :model="$brand" :h1="$brand->pivot->h1" :subtitle="$brand->pivot->subtitle" containerClass="pt-9" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.contact :model="$brand" />
    <x-ui.scroll-up />
</x-layouts.app>
