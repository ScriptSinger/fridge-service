<x-layouts.app
    :title="$page?->title ?? 'Галерея работ'"
    :description="$page?->description ?? 'Фотографии выполненных работ и отдельных этапов ремонта.'"
    :noindex="request()->query() !== []">
    <x-ui.breadcrumbs route="gallery.index" :model="null" />
    <x-sections.hero :model="$page" :h1="$page?->h1" :subtitle="$page?->subtitle" />

    <x-sections.gallery.index
        :galleries="$galleries"
        :total="$total"
        :brand-options="$brandOptions"
        :device-options="$deviceOptions"
        :active-brand="$activeBrand"
        :active-device="$activeDevice" />
    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
