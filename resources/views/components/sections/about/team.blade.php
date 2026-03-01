<x-ui.sections.wrapper>
    <x-ui.sections.header title="Наша команда" subtitle="Опытные мастера и менеджеры, которые отвечают за результат" />

    @php($teamMembers = collect(config('catalog.team', [])))

    <div class="grid gap-6 lg:grid-cols-2">
        @foreach ($teamMembers as $member)
            <x-sections.about.team-card :member="$member" />
        @endforeach
    </div>
</x-ui.sections.wrapper>
