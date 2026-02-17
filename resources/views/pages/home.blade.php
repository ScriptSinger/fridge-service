<x-layouts.app :title="$page->title" :description="$page->description">
    <x-sections.hero :model="$page" :h1="$page->h1" :subtitle="$page->subtitle" />
    <x-sections.home.devices :devices="$devices" />
    <x-sections.common.steps />
    <x-sections.common.benefits />
    <x-sections.common.gallery :galleries="$galleries" />

    <x-sections.home.faq :faqs="$faqs" />
    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
