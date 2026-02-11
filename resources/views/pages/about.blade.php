<x-layouts.app :title="$page?->title ?? 'О компании'" :description="$page?->description ?? 'Информация о сервисе ремонта бытовой техники.'">
    <x-ui.breadcrumbs route="about.index" :model="null" />
    <x-sections.hero :model="$page" h1="{{ $page?->h1 ?? 'О компании' }}"
        subtitle="{{ $page?->subtitle ?? 'Расскажем о нашем опыте, гарантиях и подходе к ремонту.' }}"
        containerClass="pt-9" />

    <x-sections.about.statistic />
    <x-sections.about.history />
    <x-sections.about.education />
    <x-sections.contact :model="$page" />

    <x-ui.scroll-up />
</x-layouts.app>
