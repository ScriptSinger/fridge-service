<x-layouts.app :title="$device->title" :description="$device->description">
    <x-ui.breadcrumbs :model="$device" route="devices.show" />
    <x-sections.hero :model="$device" />
    <x-sections.brands.brand-select :brands="$brands" :device="$device" />
    <x-sections.common.problems :problems="$problems" :device="$device" />
    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.services.index :services="$services" />
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$device" />
    <x-sections.brands.brand-carousel :brands="$brands" />
    <x-ui.scroll-up />
</x-layouts.app>
