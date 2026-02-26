<x-layouts.app title="Отзывы клиентов" description="Отзывы о ремонте бытовой техники в Уфе">
    <x-ui.breadcrumbs route="reviews.index" :model="null" />
    <x-sections.hero :model="null" :h1="'Отзывы клиентов'" :subtitle="'Реальные истории ремонтов и впечатления клиентов'" />

    <x-sections.reviews.index :reviews="$reviews" />
    <x-sections.contact :model="null" />
    <x-ui.scroll-up />
</x-layouts.app>
