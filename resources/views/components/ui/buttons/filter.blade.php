@props([
    'value' => request('sort', 'newest'),
    'queryKey' => 'sort',
    'clientSort' => false,
    'scrollOnNavigate' => false,
    'scrollStorageKey' => 'reviews:scrollAfterNav',
    'fullWidthMobile' => false,
    'options' => null,
    'eventName' => 'reviews-sort-change',
])

@php
    $defaultOptions = [
        'newest' => 'Сначала новые',
        'oldest' => 'Сначала старые',
        'positive' => 'Сначала положительные',
        'negative' => 'Сначала отрицательные',
    ];
    $options = is_array($options) && !empty($options) ? $options : $defaultOptions;
    $defaultKey = array_key_first($options) ?? 'newest';

    $currentLabel = $options[$value] ?? ($options[$defaultKey] ?? 'Фильтр');
@endphp

<div x-data="{ open: false, selected: '{{ $value }}', options: @js($options) }"
    {{ $attributes->class([
        'relative text-left',
        'inline-block' => ! $fullWidthMobile,
        'w-full sm:w-auto' => $fullWidthMobile,
    ]) }}>
    <button type="button" @click="open = !open"
        @class([
            'inline-flex items-center justify-between gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition cursor-pointer',
            'w-full sm:w-auto' => $fullWidthMobile,
        ])
        aria-haspopup="true" :aria-expanded="open">
        <span x-text="options[selected] ?? options['{{ $defaultKey }}']">{{ $currentLabel }}</span>

        <span class="inline-flex transition-transform" :class="{ 'rotate-180': open }">
            <x-heroicon-o-chevron-down class="w-4 h-4" />
        </span>
    </button>

    <div x-cloak x-show="open" @click.outside="open = false" x-transition
        class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black/5 z-20">
        <div class="py-1 text-sm">
            @foreach ($options as $key => $label)
                @if ($clientSort)
                    <button type="button"
                        @click="selected = '{{ $key }}'; open = false; $dispatch('{{ $eventName }}', { sort: '{{ $key }}' })"
                        :class="selected === '{{ $key }}' ? 'bg-gray-50 font-semibold text-gray-900' : 'text-gray-700'"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition cursor-pointer">
                        {{ $label }}
                    </button>
                @else
                    <a href="{{ request()->fullUrlWithQuery([$queryKey => $key, 'page' => null]) }}"
                        @if ($scrollOnNavigate) onclick="try { sessionStorage.setItem('{{ $scrollStorageKey }}', '1'); } catch (e) {}" @endif
                        class="block px-4 py-2 hover:bg-gray-100 transition {{ $value === $key ? 'bg-gray-50 font-semibold text-gray-900' : 'text-gray-700' }}">
                        {{ $label }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
