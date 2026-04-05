<x-layouts.app :title="$title" :description="$description">
    <x-ui.breadcrumbs :model="$brand" route="devices.brands.show" />
    <x-sections.hero :model="$brand" :h1="$brand->pivot->h1" :subtitle="$brand->pivot->subtitle" />
    <x-sections.brands.problems :problems="$problems" :device="$device" :brand="$brand" />
    <x-sections.common.gallery :galleries="$galleries" />
    @if ($services->isNotEmpty())
        <x-sections.services.index :services="$services" :brand="$brand" />
    @endif
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$brand" />
    <x-ui.scroll-up />
</x-layouts.app>
