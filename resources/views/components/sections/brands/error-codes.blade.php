@props(['errorCodes' => [], 'brand'])

@php($items = collect($errorCodes)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="error-codes">
        <x-ui.sections.header title="Коды ошибок {{ $brand->name }}"
            subtitle="Расшифровка распространённых кодов ошибок и вероятные причины." />

        <x-ui.sections.toggle-list :limit="6" :count="$items->count()">
            <div class="columns-1 gap-4 md:columns-2 md:gap-6 xl:columns-3 xl:gap-8">
                @foreach ($items as $index => $errorCode)
                    <div class="mb-4 break-inside-avoid md:mb-6 xl:mb-8" x-show="showAll || {{ $index }} < limit" x-cloak>
                        <a href="{{ route('error-codes.show', $errorCode) }}"
                            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full flex flex-col transition hover:border-yellow-300">
                            <div>
                                <h2 class="text-lg text-gray-900 font-medium title-font mb-3">
                                    {{ $errorCode->code }} — {{ $errorCode->title }}
                                </h2>
                                @if ($errorCode->subtitle)
                                    <p class="text-gray-700 leading-6">
                                        {{ $errorCode->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
