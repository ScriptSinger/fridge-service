<x-ui.sections.wrapper>

    <x-ui.sections.header title="История компании"
        subtitle="Путь развития сервиса от небольшой мастерской до современной сервисной компании" />

    <x-ui.sections.timeline :items="config('content.history')" showYear="true" image="{{ asset('assets/images/history.jpg') }}"
        imageAlt="История компании" />

</x-ui.sections.wrapper>
