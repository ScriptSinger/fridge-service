<x-ui.sections.wrapper>
    <div class="flex flex-col   w-full mb-12">
        <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"></h2>
        <p class="lg:w-2/3 leading-relaxed text-base"></p>
    </div>

    <x-ui.sections.header title="Этапы ремонта" subtitle="Как правило, ремонт выполняется в день обращения" />

    <x-ui.sections.timeline :items="config('content.steps')" image="{{ asset('assets/images/steps.webp') }}" imageAlt="Этапы ремонта" />
</x-ui.sections.wrapper>
