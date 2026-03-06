<x-layouts.app title="Галерея работ" description="Фотографии выполненных работ по ремонту бытовой техники в Уфе">
    <x-ui.breadcrumbs route="gallery.index" :model="null" />
    <x-sections.hero :model="null" :h1="'Галерея работ'" :subtitle="'Фото выполненных ремонтов и реальных кейсов'" />

    <x-sections.gallery.index
        :galleries="$galleries"
        :total="$total"
        :brand-options="$brandOptions"
        :device-options="$deviceOptions"
        :active-brand="$activeBrand"
        :active-device="$activeDevice" />
    <x-sections.contact :model="null" />
    <x-ui.scroll-up />
</x-layouts.app>
