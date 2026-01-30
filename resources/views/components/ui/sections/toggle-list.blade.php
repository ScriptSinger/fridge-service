@props([
    'limit' => 6,
    'count' => 0,
])

<div x-data="{
    showAll: false,
    limit: {{ $limit }},
}">
    {{ $slot }}

    @if ($count > $limit)
        <div class="mt-4">
            <a @click.prevent="showAll = !showAll" class="text-yellow-500 inline-flex items-center cursor-pointer">
                <span x-show="!showAll">Показать ещё</span>
                <span x-show="showAll">Скрыть</span>

                <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    @endif
</div>
