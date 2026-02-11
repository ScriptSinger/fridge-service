<x-layouts.app :title="$page?->title ?? 'Контакты'" :description="$page?->description ?? 'Контакты сервиса ремонта бытовой техники.'">
    <x-ui.breadcrumbs route="contacts.index" :model="null" />
    <x-sections.hero :model="$page" h1="{{ $page?->h1 ?? 'Контакты' }}"
        subtitle="{{ $page?->subtitle ?? 'Адрес, телефон и форма для связи.' }}" containerClass="pt-9" />

    <x-sections.contact :model="$page" />
</x-layouts.app>
