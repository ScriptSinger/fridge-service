<x-layouts.app :title="$service->seo_title ?: $service->name" :description="$service->seo_description ?: $service->description">
    <x-ui.breadcrumbs route="services.show" :model="$service" />

    <x-sections.hero :model="$service" :h1="$service->h1 ?: $service->name" :subtitle="$service->subtitle ?: $service->description" />

    <x-ui.sections.wrapper id="service-price">
        @php($price = $service->preferredPrice($device->id))
        <x-ui.sections.header title="Стоимость услуги" subtitle="Точную стоимость мастер согласует после диагностики." />
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 sm:p-6">
            <p class="text-lg text-gray-900">
                {{ $price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ' . $price->units : 'По договорённости' }}
            </p>
        </div>
    </x-ui.sections.wrapper>

    @if (filled($service->content))
        <x-ui.sections.wrapper id="service-content">
            <div class="max-w-4xl text-base leading-relaxed text-gray-600 [&_h2]:mt-10 [&_h2]:mb-4 [&_h2]:text-2xl [&_h2]:font-semibold [&_h2]:leading-tight [&_h2]:text-gray-900 [&_h3]:mt-7 [&_h3]:mb-3 [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-gray-900 [&_p]:my-4 [&_ul]:my-4 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-6 [&_ol]:my-4 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-6 [&_a]:text-yellow-700 [&_a]:underline [&_strong]:font-semibold [&_strong]:text-gray-900">
                {!! $service->content !!}
            </div>
        </x-ui.sections.wrapper>
    @endif

    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.common.faq :faqs="$faqs" />

    @if ($relatedServices->isNotEmpty())
        <x-ui.sections.wrapper id="related-services">
            <x-ui.sections.header title="Другие услуги" />
            <div class="flex flex-wrap gap-3">
                @foreach ($relatedServices as $relatedService)
                    <a href="{{ route('services.show', [$device, $relatedService->slug]) }}"
                        class="rounded border border-gray-200 px-4 py-2 text-gray-700 transition hover:border-yellow-500 hover:text-yellow-700">
                        {{ $relatedService->name }}
                    </a>
                @endforeach
            </div>
        </x-ui.sections.wrapper>
    @endif

    <x-sections.contact :model="$service" />
    <x-ui.scroll-up />
</x-layouts.app>
