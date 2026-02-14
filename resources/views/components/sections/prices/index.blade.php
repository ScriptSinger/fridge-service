@props(['devices'])

<x-ui.sections.wrapper id="pricing">
    <x-ui.sections.header title="Примерные цены на ремонт бытовой техники"
        subtitle="Выберите тип техники, чтобы посмотреть ориентировочные цены" />

    <div class="space-y-4">
        @foreach ($devices as $device)
            <details class="group rounded-lg border border-gray-200 bg-white"
                @if ($loop->first) open @endif>
                <summary class="cursor-pointer list-none px-4 py-3 flex items-center justify-between">
                    <span class="font-semibold text-gray-900">{{ $device->type }}</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200 group-open:rotate-180"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>

                </summary>

                <div class="px-4 pb-4">
                    <div class="hidden md:block">
                        @include('components.sections.prices.table', [
                            'services' => $device->services,
                        ])
                    </div>

                    <div class="md:hidden">
                        @include('components.sections.prices.mobile', [
                            'services' => $device->services,
                        ])
                    </div>
                </div>
            </details>
        @endforeach
    </div>
</x-ui.sections.wrapper>
