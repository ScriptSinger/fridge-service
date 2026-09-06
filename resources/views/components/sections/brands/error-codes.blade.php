@props(['errorCodes' => [], 'device', 'brand'])

@php($items = collect($errorCodes)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="error-codes">
        <x-ui.sections.header title="Коды ошибок {{ $brand->name }}"
            subtitle="Что означают распространённые коды ошибок — подробнее о причинах и ремонте на странице каждого кода." />

        <x-ui.sections.toggle-list :limit="10" :count="$items->count()">
            <div class="w-full overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-100">Код</th>
                            <th class="px-4 py-3 bg-gray-100">Расшифровка</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $index => $errorCode)
                            <tr x-show="showAll || {{ $index }} < limit" x-cloak>
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    <a href="{{ route('error-codes.show', [$device, $errorCode->slug]) }}"
                                        class="font-medium text-gray-900 hover:text-yellow-600 hover:underline">
                                        {{ $errorCode->code }}
                                    </a>
                                </td>
                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                    <a href="{{ route('error-codes.show', [$device, $errorCode->slug]) }}"
                                        class="hover:text-yellow-600 hover:underline">
                                        {{ $errorCode->subtitle ?: $errorCode->title }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
