@props(['problems' => [], 'device'])

@php($items = collect($problems)->values())

@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="problems">
        <x-ui.sections.header
            title="Частые неисправности {{ $device->typeInCase('genitive_plural') }}"
            subtitle="Мы собрали самые распространённые поломки и причины их возникновения." />

        <x-ui.sections.toggle-list :limit="6" :mobile-limit="4" :count="$items->count()">
            <div class="columns-1 gap-4 md:columns-2 md:gap-6 xl:columns-3 xl:gap-8">
                @foreach ($items as $index => $problem)
                    <x-ui.sections.content-card :problem="$problem" :device="$device"
                        class="mb-4 break-inside-avoid md:mb-6 xl:mb-8" x-show="showAll || {{ $index }} < limit" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1" />
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
