@props(['errorCodes' => [], 'device'])

@php($groups = collect($errorCodes)->filter(fn($errorCode) => $errorCode->brand)->groupBy(fn($errorCode) => $errorCode->brand->name)->sortKeys())

@if ($groups->isNotEmpty())
    <x-ui.sections.wrapper id="error-codes">
        <x-ui.sections.header title="Коды ошибок {{ $device->typeInCase('genitive_plural') }} по брендам"
            subtitle="Выберите код с дисплея — расскажем, что он означает и как устраняется неисправность." />

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-3 xl:gap-8">
            @foreach ($groups as $brandName => $items)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg text-gray-900 font-medium title-font mb-3">
                        <a href="{{ route('devices.brands.show', [$device, $items->first()->brand]) }}#error-codes"
                            class="hover:text-yellow-600 hover:underline">
                            {{ $brandName }}
                        </a>
                    </h3>

                    <ul class="flex flex-wrap gap-2">
                        @foreach ($items as $errorCode)
                            <li>
                                <a href="{{ route('error-codes.show', [$device, $errorCode->slug]) }}"
                                    title="{{ $errorCode->subtitle ?: $errorCode->title }}"
                                    class="inline-block rounded-full border border-gray-200 px-3 py-1 text-sm font-medium text-gray-900 transition hover:border-yellow-300 hover:text-yellow-600">
                                    {{ $errorCode->code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </x-ui.sections.wrapper>
@endif
