<x-layouts.app :title="$brand->pivot->title" :description="$brand->pivot->description">
    <x-ui.breadcrumbs :model="$brand" route="services.brands.show" />
    <x-sections.hero :model="$brand" containerClass="pt-9" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.contact :model="$brand" />
    <x-ui.scroll-up />
</x-layouts.app>
