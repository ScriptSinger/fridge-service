@props([
    'variant' => 'header',
])

@php
    $items = config('navigation', []);
@endphp

@php
    $resolveHref = function (array $item): string {
        if (!empty($item['route'])) {
            return route($item['route']);
        }

        return $item['href'] ?? '#';
    };
@endphp

@if ($variant === 'footer')
    <nav class="list-none mb-10">
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ $resolveHref($item) }}" class="text-gray-600 hover:text-gray-800">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@elseif ($variant === 'mobile')
    <nav {{ $attributes->merge(['class' => 'md:hidden']) }} x-cloak x-show="open" @click.away="open = false">
        <div class="container mx-auto px-4 pb-4">
            @foreach ($items as $item)
                <a href="{{ $resolveHref($item) }}" class="block py-2 text-base hover:text-gray-900" @click="open = false">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </nav>
@else
    <nav {{ $attributes->merge(['class' => 'hidden md:flex md:ml-auto md:items-center md:text-base md:justify-center']) }}>
        @foreach ($items as $item)
            <a href="{{ $resolveHref($item) }}" class="mr-5 hover:text-gray-900">{{ $item['label'] }}</a>
        @endforeach
    </nav>
@endif
