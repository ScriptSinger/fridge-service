<x-layouts.app :title="$page->title" :description="$page->description">
    <x-sections.hero :model="$page" :h1="$page->h1" :subtitle="$page->subtitle" />
    <x-sections.home.services :services="$services" />
    <x-sections.home.steps />
    <x-sections.home.pricing />
    <x-sections.home.blog :problems="$problems" />
    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
