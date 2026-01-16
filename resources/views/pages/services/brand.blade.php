<x-layouts.app :title="$brand->pivot->title" :description="$brand->pivot->description">
    <x-ui.breadcrumbs :model="$brand" route="services.brands.show" />
    <x-sections.brands.hero :brand="$brand" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.home.contact />
    <x-ui.scroll-up />
</x-layouts.app>
