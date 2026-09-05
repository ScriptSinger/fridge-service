@php
    $hasContent = filled($errorCode->content);
    $hasProblems = $errorCode->problems->isNotEmpty();
    $hasBrand = (bool) $errorCode->brand;
    $hasMeta = $hasProblems || $hasBrand;
@endphp

<x-layouts.app :title="$errorCode->seo_title ?: $errorCode->h1" :description="$errorCode->seo_description ?: $errorCode->short_content">
    <x-ui.breadcrumbs route="error-codes.show" :model="$errorCode" />

    <x-sections.hero :model="$errorCode" :h1="$errorCode->h1" :subtitle="$errorCode->subtitle" compact />

    @if ($hasContent || $hasMeta)
        <x-ui.sections.wrapper id="error-code-detail">
            <div @class([
                    'grid gap-8 lg:items-start',
                    'lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]' => $hasContent && $hasMeta,
                ])>
                @if ($hasContent)
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm lg:self-start">
                        <div class="prose prose-gray max-w-none prose-headings:text-gray-900 prose-h2:mt-8 prose-h2:mb-3 prose-h3:mt-6 prose-h3:mb-2 prose-a:text-yellow-700 prose-strong:text-gray-900 prose-img:mx-auto prose-img:rounded-2xl prose-img:shadow-sm prose-figure:mx-auto prose-figcaption:text-center">
                            {!! $errorCode->content !!}
                        </div>
                    </div>
                @endif

                @if ($hasMeta)
                    <div class="flex flex-col gap-8">
                        @if ($hasProblems)
                            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Возможные причины</h2>

                                <div class="flex flex-wrap gap-2">
                                    @foreach ($errorCode->problems as $problem)
                                        @if ($problem->device)
                                            <a href="{{ route('problems.show', [$problem->device, $problem->slug]) }}"
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                                {{ $problem->title }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($hasBrand)
                            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $device->permalink }}</h2>

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('devices.brands.show', [$device, $errorCode->brand]) }}"
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                        {{ $errorCode->brand->name }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </x-ui.sections.wrapper>
    @endif

    <x-sections.common.gallery :galleries="$galleries" />

    <x-sections.contact :model="$errorCode" />
    <x-ui.scroll-up />
</x-layouts.app>
