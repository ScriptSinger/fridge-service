@props([
    'href' => '#',
    'label' => '',
])

<a href="{{ $href }}"
    class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-full text-sm font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900">
    {{ $label ?: $slot }}
    <span class="ml-2">→</span>
</a>
