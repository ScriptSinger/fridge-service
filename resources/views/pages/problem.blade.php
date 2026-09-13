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
                        <div
                            x-data="contentLightbox()"
                            x-init="init()"
                            class="prose prose-gray max-w-none prose-headings:text-gray-900 prose-h2:mt-8 prose-h2:mb-3 prose-h3:mt-6 prose-h3:mb-2 prose-a:text-yellow-700 prose-strong:text-gray-900 prose-img:mx-auto prose-img:rounded-2xl prose-img:shadow-sm prose-img:cursor-zoom-in prose-figure:mx-auto prose-figcaption:text-center">
                            {!! $problem->content !!}

                            <template x-teleport="body">
                                <div x-cloak x-show="open" x-transition.opacity @keydown.window="handleKeydown($event)"
                                    @click="close()" class="fixed inset-0 z-[120] bg-black/80 p-4 sm:p-6"
                                    role="dialog" aria-modal="true" :aria-label="alt || 'Изображение'" tabindex="-1"
                                    x-ref="dialog">
                                    <div class="relative mx-auto flex h-full max-w-6xl items-center justify-center"
                                        @click.stop>
                                        <button type="button" @click="close()"
                                            class="fixed top-4 right-4 sm:top-6 sm:right-6 h-12 w-12 rounded-full bg-white/95 text-gray-900 shadow-lg hover:bg-white z-[130] cursor-pointer"
                                            aria-label="Закрыть">
                                            <span class="text-2xl leading-none">&times;</span>
                                        </button>

                                        <img :src="src" :alt="alt" decoding="async"
                                            class="max-h-full w-auto max-w-full rounded-xl object-contain">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                @endif

                @if ($hasMeta)
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Информация</h2>

                        <div class="flex flex-wrap gap-2">
                            @foreach ($problem->services as $service)
                                <a href="{{ route('services.show', [$device, $service->slug]) }}"
                                    class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                    {{ $service->name }}
                                </a>
                            @endforeach

                            @foreach ($problem->brands as $brand)
                                <a href="{{ route('devices.brands.show', [$device, $brand]) }}"
                                    class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                    {{ $brand->name }}
                                </a>
                            @endforeach

                            @foreach ($problem->errorCodes as $errorCode)
                                @if ($errorCode->slug && $errorCode->device)
                                    <a href="{{ route('error-codes.show', [$errorCode->device, $errorCode->slug]) }}"
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium hover:bg-yellow-100 hover:text-yellow-700">
                                        {{ $errorCode->title }}
                                    </a>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                                        {{ $errorCode->title }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </x-ui.sections.wrapper>
    @endif

    <x-sections.common.gallery :galleries="$galleries" />

    <x-sections.contact :model="$problem" />
    <x-ui.scroll-up />
</x-layouts.app>
