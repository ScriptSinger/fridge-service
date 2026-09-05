@props([
    'galleries',
    'total' => 0,
    'brandOptions' => ['all' => 'Все бренды'],
    'deviceOptions' => ['all' => 'Вся техника'],
    'activeBrand' => 'all',
    'activeDevice' => 'all',
])

<x-ui.sections.wrapper id="gallery-index-section" class="bg-gray-50" x-data="gallerySectionScroll()" x-init="init()" x-ref="section">
    <x-ui.sections.header suptitle="Галерея работ" title="Примеры работ"
        subtitle="На странице {{ $total }} фото выполненных ремонтов">
    </x-ui.sections.header>

    <div>
        <div class="mb-8 flex flex-col items-stretch gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
            <x-ui.buttons.filter :value="$activeBrand" :options="$brandOptions" :query-key="'brand'" :scroll-on-navigate="true"
                :scroll-storage-key="'gallery:scrollAfterNav'" :full-width-mobile="true" />
            <x-ui.buttons.filter :value="$activeDevice" :options="$deviceOptions" :query-key="'device'" :scroll-on-navigate="true"
                :scroll-storage-key="'gallery:scrollAfterNav'" :full-width-mobile="true" />
            <x-ui.buttons.filter :value="request('sort', 'newest')" :options="[
                'newest' => 'Сначала новые',
                'oldest' => 'Сначала старые',
            ]" :query-key="'sort'" :scroll-on-navigate="true" :scroll-storage-key="'gallery:scrollAfterNav'"
                :full-width-mobile="true" />
        </div>

        <div class="columns-1 gap-4 md:columns-2 md:gap-6 xl:columns-3 xl:gap-8">
            @foreach ($galleries as $gallery)
                <div class="mb-4 break-inside-avoid md:mb-6 xl:mb-8">
                    <x-sections.gallery.gallery-card :gallery="$gallery" />
                </div>
            @endforeach
        </div>

        @if ($galleries->isEmpty())
            <div class="mt-8 rounded-2xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-600">
                По выбранным параметрам пока нет работ.
            </div>
        @endif

        <div class="mt-8">
            {{ $galleries->links() }}
        </div>
    </div>
</x-ui.sections.wrapper>
