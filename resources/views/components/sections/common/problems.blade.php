@props(['problems' => [], 'device'])

@php($items = collect($problems)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="problems">
        <x-ui.sections.header
            title="Частые неисправности {{ $device->typeInCase('genitive_plural') }}"
            subtitle="Мы собрали самые распространённые поломки {{ $device->typeInCase('genitive_plural') }}" />

        <x-ui.sections.toggle-list :limit="6" :count="$items->count()" x-data="problemsMasonry()">
            <div x-ref="grid" class="relative space-y-4 md:space-y-0">
                @foreach ($items as $index => $problem)
                    <x-ui.sections.content-card :problem="$problem" x-show="showAll || {{ $index }} < limit" x-cloak />
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
