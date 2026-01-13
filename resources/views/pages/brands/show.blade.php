<x-layouts.app>
    <x-ui.breadcrumbs :model="$brand" route="brands.show" />
    <x-sections.brands.hero :brand="$brand" />

    <x-sections.home.steps />
    <x-sections.home.pricing />

    <x-sections.home.contact />
    <x-ui.scroll-up />
</x-layouts.app>
