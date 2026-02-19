<x-layouts.app :title="$device->title" :description="$device->description">
    <x-ui.breadcrumbs :model="$device" route="devices.show" />
    <x-sections.hero :model="$device" :h1="$device->h1" :subtitle="$device->subtitle" containerClass="pt-9" />
    <x-sections.brands :models="$brands" :device="$device" />
    <x-sections.common.problems :problems="$problems" :device="$device" />
    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.common.services.index :services="$services" />
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$device" />
    <x-ui.scroll-up />
</x-layouts.app>
