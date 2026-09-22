<x-ui.sections.wrapper>
    <x-ui.sections.header title="Этапы ремонта" subtitle="Как правило, ремонт выполняется в день обращения" />

    <x-ui.sections.timeline :items="config('content.steps')" image="{{ asset('assets/images/steps.webp') }}" imageAlt="Этапы ремонта" />
</x-ui.sections.wrapper>
