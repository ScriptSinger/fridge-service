@props(['device', 'brands'])

@php
    $items = collect($brands)->filter(fn($b) => !empty($b->slug))->values();
@endphp

{{-- A visible grid instead of a search box: with ~15 brands scanning logos is faster than typing,
     and the hub's most important internal links stay real, visible links for crawlers --}}
@if ($items->isNotEmpty())
    <x-ui.sections.wrapper id="brand-select">
        <x-ui.sections.header title="Выберите бренд {{ Str::lower($device->typeInCase('genitive')) }}"
            subtitle="Ремонтируем все популярные марки — выберите свою" />

        <x-ui.sections.toggle-list :limit="11" :mobileLimit="7" :count="$items->count()" toggleSpacingClass="mt-6">
            <ul class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 md:gap-4">
                @foreach ($items as $index => $brand)
                    <li x-show="showAll || {{ $index }} < limit" @if ($index >= 7) x-cloak @endif>
                        <a href="{{ route('devices.brands.show', [$device->slug, $brand->slug]) }}"
                            class="flex h-full flex-col items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-4 text-center transition hover:border-yellow-500 hover:shadow-md">
                            @if ($brand->image)
                                <img src="{{ $brand->image_url }}" alt="" loading="lazy" decoding="async"
                                    width="128" height="48" class="h-10 w-full object-contain md:h-12">
                            @endif
                            <span class="font-semibold text-gray-900">{{ $brand->name }}</span>
                            @if ($brand->name_ru && $brand->name_ru !== $brand->name)
                                <span class="-mt-2 text-xs text-gray-500">{{ $brand->name_ru }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach

                {{-- Always last and always visible: a visitor whose brand isn't listed calls instead of leaving --}}
                <li>
                    <a href="tel:{{ config('contacts.phone_tel') }}" data-contact-channel="phone"
                        class="flex h-full flex-col items-center justify-center gap-1 rounded-lg border border-dashed border-yellow-500 bg-yellow-50 p-4 text-center transition hover:shadow-md">
                        <span class="font-semibold text-gray-900">Не нашли свой бренд?</span>
                        <span class="text-xs text-gray-600">Консультация мастера бесплатно — звоните</span>
                    </a>
                </li>
            </ul>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
