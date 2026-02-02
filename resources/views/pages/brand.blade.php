<x-layouts.app :title="$device->title" :description="$device->description">
    <x-ui.breadcrumbs :model="$brand" route="devices.brands.show" />
    <x-sections.hero :model="$brand" :h1="$brand->pivot->h1" :subtitle="$brand->pivot->subtitle" containerClass="pt-9" />
    <x-sections.brands.problems :problems="$problems" :device="$device" :brand="$brand" />
    <x-sections.common.services.index :services="$services" />
    <x-sections.common.steps />
    <x-sections.contact :model="$brand" />
    <x-ui.scroll-up />
</x-layouts.app>
