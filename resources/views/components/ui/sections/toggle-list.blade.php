@props([
    'limit' => 6,
    'mobileLimit' => null,
    'count' => 0,
    'toggleSpacingClass' => 'mt-4',
    'xData' => null,
])

@php
    $desktopLimit = $limit;
    $mobileLimit = $mobileLimit ?? $limit;
    $baseData = "{
        showAll: false,
        limit: {$desktopLimit},
        desktopLimit: {$desktopLimit},
        mobileLimit: {$mobileLimit},
        count: {$count},
        applyLimit() { this.limit = window.matchMedia('(min-width: 768px)').matches ? this.desktopLimit : this.mobileLimit; },
    }";
    $dataExpression = $xData ? "Object.assign({$baseData}, {$xData})" : $baseData;
@endphp

<div x-data="{{ $dataExpression }}"
    x-init="applyLimit(); window.addEventListener('resize', () => applyLimit()); typeof init === 'function' && init()">
    {{ $slot }}

    <div x-show="count > limit" x-cloak class="{{ $toggleSpacingClass }}">
        <button type="button" @click="showAll = !showAll; $nextTick(() => $dispatch('masonry:refresh'))"
            class="text-yellow-500 inline-flex items-center cursor-pointer">
            <span x-show="!showAll">Показать ещё</span>
            <span x-show="showAll">Скрыть</span>

            <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': showAll }" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
