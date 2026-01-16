<x-layouts.app :title="$page->title" :description="$page->description">
    <x-sections.home.hero :page="$page" />
    <x-sections.home.services :services="$services" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.home.blog :problems="$problems" />
    <x-sections.home.contact />
    <x-ui.scroll-up />
</x-layouts.app>
