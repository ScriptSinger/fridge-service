<x-layouts.app :title="$device->title" :description="$device->description">
    <x-ui.breadcrumbs :model="$brand" route="devices.brands.show" />
    <x-sections.hero :model="$brand" :h1="$brand->pivot->h1" :subtitle="$brand->pivot->subtitle" containerClass="pt-9" />
    <x-sections.common.steps />
    <x-sections.common.pricing />
    <x-sections.contact :model="$brand" />
    <x-ui.scroll-up />
</x-layouts.app>
