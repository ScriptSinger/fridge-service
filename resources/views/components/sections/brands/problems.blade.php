@props(['problems' => [], 'device', 'brand'])

@php($items = collect($problems)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="problems">
        <x-ui.sections.header
            title="Частые неисправности {{ Str::lower($device->typeInCase('genitive')) }} {{ $brand->name }}"
            subtitle="Мы собрали самые распространённые поломки {{ Str::lower($device->typeInCase('genitive')) }}" />

        <x-ui.sections.toggle-list :limit="6" :count="$items->count()">
            <div class="flex flex-wrap -m-4">
                @foreach ($items as $index => $problem)
                    <x-ui.sections.content-card :problem="$problem" x-show="showAll || {{ $index }} < limit" x-cloak />
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
