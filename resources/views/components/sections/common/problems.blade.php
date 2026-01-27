<x-ui.sections.wrapper id="problems">
    <x-ui.sections.header title="Частые неисправности {{ Str::lower($device->typeInCase('genitive')) }}"
        subtitle="Мы собрали самые распространённые поломки {{ Str::lower($device->typeInCase('genitive')) }}, с которыми к нам обращаются клиенты. Для каждой проблемы указаны симптомы, причины и возможные способы ремонта." />

    <div x-data="{ showAll: false }">
        <div class="flex flex-wrap -m-4">
            @foreach ($problems as $index => $problem)
                <x-ui.sections.content-card :problem="$problem" x-show="showAll || {{ $index }} < 6" />
            @endforeach
        </div>

        @if (count($problems) > 6)
            <div class="text-center mt-8">
                <x-ui.buttons.toggle-button @click="showAll = !showAll">
                    <span x-show="!showAll">Показать ещё</span>
                    <span x-show="showAll">Скрыть</span>
                </x-ui.buttons.toggle-button>
            </div>
        @endif
    </div>
</x-ui.sections.wrapper>
