<x-layouts.app :title="$page?->title ?? 'О компании'" :description="$page?->description ?? 'Информация о сервисе ремонта бытовой техники.'">
    <x-ui.breadcrumbs route="about.index" :model="null" />
    <x-sections.hero :model="$page" :h1="$page?->h1" :subtitle="$page?->subtitle" />
    <x-sections.about.statistic />
    <x-sections.about.history />
    <x-sections.about.team />
    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$page" />
    <x-ui.scroll-up />
</x-layouts.app>
