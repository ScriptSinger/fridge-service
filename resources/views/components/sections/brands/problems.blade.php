@props(['problems' => [], 'device', 'brand'])

@php($items = collect($problems)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="problems">
        <x-ui.sections.header
            title="Частые неисправности {{ $device->typeInCase('genitive_plural') }} {{ $brand->name }}"
            subtitle="Мы собрали самые распространённые поломки и причины их возникновения." />

        <x-ui.sections.toggle-list :limit="6" :count="$items->count()">
            <div class="columns-1 gap-4 md:columns-2 md:gap-6 xl:columns-3 xl:gap-8">
                @foreach ($items as $index => $problem)
                    <x-ui.sections.content-card :problem="$problem" :device="$device"
                        class="mb-4 break-inside-avoid md:mb-6 xl:mb-8" x-show="showAll || {{ $index }} < limit" x-cloak />
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
