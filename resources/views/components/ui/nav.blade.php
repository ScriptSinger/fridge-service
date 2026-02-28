@props([
    'variant' => 'header',
])

@php($navItems = $navItems ?? collect())
@php($repairItems = $repairItems ?? collect())
@php($primaryNavItems = $navItems->take(2))
@php($extraNavItems = $navItems->slice(2)->values())

@if ($variant === 'footer')
    <nav class="list-none mb-10">
        <ul>
            @foreach ($navItems as $item)
                <li>
                    <a href="{{ $item['href'] }}" class="text-gray-600 hover:text-gray-800">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@elseif ($variant === 'mobile')
    <nav {{ $attributes->merge(['class' => 'md:hidden']) }} x-cloak x-show="open" @click.away="open = false">
        <div class="container mx-auto px-4 pb-4" x-data="{ repairOpen: false, moreOpen: false }">
            <div class="py-2">
                <button type="button"
                    class="w-full text-left text-base hover:text-gray-900 cursor-pointer inline-flex items-center justify-between"
                    @click="repairOpen = !repairOpen">
                    <span>Ремонт</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': repairOpen }" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="pl-4 mt-1" x-show="repairOpen" x-transition>
                    @foreach ($repairItems as $repairItem)
                        <a href="{{ $repairItem['href'] }}" class="block py-2 hover:text-gray-900"
                            @click="open = false; repairOpen = false">
                            {{ $repairItem['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
            @foreach ($primaryNavItems as $item)
                <a href="{{ $item['href'] }}" class="block py-2 text-base hover:text-gray-900" @click="open = false">
                    {{ $item['label'] }}
                </a>
            @endforeach

            @if ($extraNavItems->isNotEmpty())
                <div class="py-2">
                    <button type="button"
                        class="w-full text-left text-base hover:text-gray-900 cursor-pointer inline-flex items-center justify-between"
                        @click="moreOpen = !moreOpen">
                        <span>Ещё</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': moreOpen }" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="pl-4 mt-1" x-show="moreOpen" x-transition>
                        @foreach ($extraNavItems as $item)
                            <a href="{{ $item['href'] }}" class="block py-2 hover:text-gray-900"
                                @click="open = false; moreOpen = false">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </nav>
@else
    <nav
        {{ $attributes->merge(['class' => 'hidden md:flex md:ml-auto md:items-center md:text-base md:justify-center']) }}>
        <div class="relative mr-5" x-data="{ repairOpen: false }" @mouseenter="repairOpen = true"
            @mouseleave="repairOpen = false">
            <button type="button" class="hover:text-gray-900 cursor-pointer inline-flex items-center gap-1"
                @click="repairOpen = !repairOpen">
                <span>Ремонт</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': repairOpen }" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="absolute left-0 top-full pt-4 w-56 z-50" x-show="repairOpen" x-transition x-cloak>
                <div class="rounded-md border border-gray-200 bg-white shadow-lg py-2">
                    @foreach ($repairItems as $repairItem)
                        <a href="{{ $repairItem['href'] }}" class="block px-4 py-2 hover:text-gray-900">
                            {{ $repairItem['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @foreach ($primaryNavItems as $item)
            <a href="{{ $item['href'] }}" class="mr-5 hover:text-gray-900">{{ $item['label'] }}</a>
        @endforeach

        @if ($extraNavItems->isNotEmpty())
            <div class="relative mr-5" x-data="{ moreOpen: false }" @mouseenter="moreOpen = true"
                @mouseleave="moreOpen = false">
                <button type="button" class="hover:text-gray-900 cursor-pointer inline-flex items-center gap-1"
                    @click="moreOpen = !moreOpen">
                    <span>Ещё</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': moreOpen }" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full pt-4 w-56 z-50" x-show="moreOpen" x-transition x-cloak>
                    <div class="rounded-md border border-gray-200 bg-white shadow-lg py-2">
                        @foreach ($extraNavItems as $item)
                            <a href="{{ $item['href'] }}" class="block px-4 py-2 hover:text-gray-900">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </nav>
@endif
