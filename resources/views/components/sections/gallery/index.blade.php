@props(['galleries'])

@php
    $total = $galleries->count();
@endphp

<x-ui.sections.wrapper class="bg-gray-50">
    <x-ui.sections.header suptitle="Галерея работ" title="Реальные кейсы"
        subtitle="На странице {{ $total }} фото выполненных ремонтов">
    </x-ui.sections.header>

    <div x-data="galleryIndexSort(@js(request('sort', 'newest')))" x-init="init()">
        <div class="mb-8 flex justify-end">
            <x-ui.buttons.filter :value="request('sort', 'newest')" :options="[
                'newest' => 'Сначала новые',
                'oldest' => 'Сначала старые',
            ]" :event-name="'gallery-sort-change'" :client-sort="true" />
        </div>

        <div x-ref="grid" class="columns-1 md:columns-2 xl:columns-3 gap-8 space-y-8">
            @foreach ($galleries as $gallery)
                <div class="break-inside-avoid" data-created-ts="{{ $gallery->created_at?->timestamp ?? 0 }}">
                    <x-sections.gallery.gallery-card :gallery="$gallery" />
                </div>
            @endforeach
        </div>
    </div>
</x-ui.sections.wrapper>
