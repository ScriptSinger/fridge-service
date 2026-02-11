<x-layouts.app :title="'Неисправности бытовой техники'" :description="'Типовые неисправности по видам техники. Симптомы, причины и что делать дальше.'">
    <x-ui.breadcrumbs route="problems.index" :model="null" />
    <x-sections.hero :model="null" h1="Неисправности"
        subtitle="Ниже собраны типовые неисправности по видам техники. Нажмите на карточку, чтобы увидеть описание."
        containerClass="pt-9" />

    @foreach ($devices as $device)
        @if ($device->problems->isNotEmpty())
            <x-ui.sections.wrapper>
                <x-ui.sections.header :title="$device->type" :subtitle="$device->subtitle" />
                <div class="flex flex-wrap -m-4">
                    @foreach ($device->problems as $problem)
                        <x-ui.sections.content-card :problem="$problem" />
                    @endforeach
                </div>
            </x-ui.sections.wrapper>
        @endif
    @endforeach
</x-layouts.app>
