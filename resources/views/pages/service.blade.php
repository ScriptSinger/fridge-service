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
            <div class="prose max-w-none text-gray-600">
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
