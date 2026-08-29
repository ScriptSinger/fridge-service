@php
    $hasContent = filled($service->content);
    $price = $service->preferredPrice($device->id);
@endphp

<x-layouts.app :title="$service->seo_title ?: $service->name" :description="$service->seo_description ?: $service->description">
    <x-ui.breadcrumbs route="services.show" :model="$service" />

    <x-sections.hero :model="$service" :h1="$service->h1 ?: $service->name" :subtitle="$service->subtitle ?: $service->description" compact />

    <x-ui.sections.wrapper id="service-detail">
        <div @class([
            'grid gap-8 lg:items-start',
            'lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]' => $hasContent,
        ])>
            @if ($hasContent)
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:self-start">
                    <div
                        class="prose prose-gray max-w-none prose-headings:text-gray-900 prose-h2:mt-8 prose-h2:mb-3 prose-h3:mt-6 prose-h3:mb-2 prose-a:text-yellow-700 prose-strong:text-gray-900 prose-img:mx-auto prose-img:rounded-2xl prose-img:shadow-sm prose-figure:mx-auto prose-figcaption:text-center">
                        {!! $service->content !!}
                    </div>
                </div>
            @endif

            <div class="flex flex-col gap-8">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Стоимость услуги</h2>
                    <p class="text-sm text-gray-500 mb-5">Точную стоимость мастер согласует после диагностики.</p>

                    <div class="rounded-xl bg-gray-50 border border-gray-200 p-5">
                        @if ($price?->price_from)
                            <p class="text-sm text-gray-600 mb-1">Цена от</p>
                            <p class="text-3xl font-bold">
                                {{ number_format($price->price_from, 0, '.', ' ') }}
                                <span class="text-lg font-medium text-gray-600">{{ $price->units }}</span>
                            </p>
                        @else
                            <p class="text-lg font-semibold text-gray-900">По договорённости</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-ui.sections.wrapper>

    <x-sections.common.gallery :galleries="$galleries" />
    <x-sections.common.faq :faqs="$faqs" />

    @if ($relatedServices->isNotEmpty())
        <x-ui.sections.wrapper id="related-services" innerClass="container mx-auto px-5 py-8 md:py-10">
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
