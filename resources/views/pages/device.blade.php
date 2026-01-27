<x-layouts.app :title="$device->title" :description="$device->description">
    <x-ui.breadcrumbs :model="$device" route="devices.show" />
    <x-sections.hero :model="$device" :h1="$device->h1" :subtitle="$device->subtitle" containerClass="pt-9" />
    <x-sections.common.problems :problems="$problems" :device="$device" />
    <x-sections.brands :models="$brands" :device="$device" />
    <x-sections.common.steps />
    <x-sections.common.pricing />
    <x-sections.contact :model="$device" />
    <x-ui.scroll-up />
</x-layouts.app>
