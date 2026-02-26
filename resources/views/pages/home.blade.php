<x-layouts.app :title="$page->title" :description="$page->description">
    <x-sections.hero :model="$page" />
    <x-sections.home.devices :devices="$devices" />
    <x-sections.common.benefits />
    <x-sections.common.steps />
    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.common.reviews :reviews="$reviews" />
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
