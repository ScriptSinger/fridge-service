<x-layouts.app :title="$page?->title" :description="$page?->description">
    <x-ui.breadcrumbs route="contacts.index" :model="null" />
    <x-sections.hero :model="$page" :h1="$page?->h1" :subtitle="$page?->subtitle" />

    <x-sections.contacts.info />
    <x-sections.common.faq :faqs="$faqs" />
    <x-sections.contact :model="$page" />
</x-layouts.app>
