@props([
    'value' => request('sort', 'newest'),
    'clientSort' => false,
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

<div x-data="{ open: false, selected: '{{ $value }}', options: @js($options) }" class="relative inline-block text-left">
    <button type="button" @click="open = !open"
        class="inline-flex items-center justify-between gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition cursor-pointer"
        aria-haspopup="true" :aria-expanded="open">
        <span x-text="options[selected] ?? options['{{ $defaultKey }}']">{{ $currentLabel }}</span>

        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.7a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="open" @click.outside="open = false" x-transition
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
                    <a href="{{ request()->fullUrlWithQuery(['sort' => $key]) }}"
                        class="block px-4 py-2 hover:bg-gray-100 transition {{ $value === $key ? 'bg-gray-50 font-semibold text-gray-900' : 'text-gray-700' }}">
                        {{ $label }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
