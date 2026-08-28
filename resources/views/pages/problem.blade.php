@php
    $hasContent = filled($problem->content);
    $hasServices = $problem->services->isNotEmpty();
    $hasBrands = $problem->brands->isNotEmpty() || $problem->errorCodes->isNotEmpty();
    $hasMeta = $hasServices || $hasBrands;
@endphp

<x-layouts.app :title="$problem->seo_title ?: $problem->h1" :description="$problem->seo_description ?: $problem->short_content">
    <x-ui.breadcrumbs route="problems.show" :model="$problem" />

    <x-sections.hero :model="$problem" :h1="$problem->h1" :subtitle="$problem->subtitle" compact />

    @if ($hasContent || $hasMeta)
        <x-ui.sections.wrapper id="problem-detail">
            <div @class([
                    'grid gap-8 lg:items-start',
                    'lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]' => $hasContent && $hasMeta,
                ])>
                @if ($hasContent)
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:self-start">
                        <div class="prose prose-gray max-w-none prose-headings:text-gray-900 prose-h2:mt-8 prose-h2:mb-3 prose-h3:mt-6 prose-h3:mb-2 prose-a:text-yellow-700 prose-strong:text-gray-900 prose-img:mx-auto prose-img:rounded-2xl prose-img:shadow-sm prose-figure:mx-auto prose-figcaption:text-center">
                            {!! $problem->content !!}
                        </div>
                    </div>
                @endif

                @if ($hasMeta)
                    <div class="flex flex-col gap-8">
                        @if ($hasServices)
                            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Услуги</h2>

                                <div class="flex flex-wrap gap-2">
                                    @foreach ($problem->services as $service)
                                        <a href="{{ route('services.show', [$device, $service->slug]) }}"
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                            {{ $service->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($hasBrands)
                            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Бренды</h2>

                                <div class="flex flex-wrap gap-2">
                                    @foreach ($problem->brands as $brand)
                                        <a href="{{ route('devices.brands.show', [$device, $brand]) }}"
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                            {{ $brand->name }}
                                        </a>
                                    @endforeach

                                    @foreach ($problem->errorCodes as $errorCode)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                                            {{ $errorCode->title }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </x-ui.sections.wrapper>
    @endif

    <x-sections.contact :model="$problem" />
    <x-ui.scroll-up />
</x-layouts.app>
