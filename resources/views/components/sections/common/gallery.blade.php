@props(['galleries'])

@php
    $slides = $galleries
        ->filter(fn($item) => !empty($item->image))
        ->map(
            fn($item) => [
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'description' => $item->description,
                'image' => $item->image_url,
                'image_alt' => $item->image_alt ?: $item->title,
            ],
        )
        ->values();
@endphp

@if ($slides->isNotEmpty())
    <x-ui.sections.wrapper>
        <x-ui.sections.header title="Примеры выполненных работ"
            subtitle="Реальные кейсы и типовые задачи, которые мы решаем" />

        <x-sections.gallery.slider :slides="$slides->all()" />
    </x-ui.sections.wrapper>
@endif
