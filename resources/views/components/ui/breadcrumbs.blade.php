<section class="bg-white">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center text-sm">
        <nav aria-label="breadcrumb" class="flex items-center">
            <ol class="flex items-center space-x-1 text-gray-500">
                @php
                    $breadcrumbs = $route ? Breadcrumbs::generate($route, $model) : Breadcrumbs::current();
                @endphp

                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="flex items-center">
                        @if ($breadcrumb->url && !$loop->last)
                            <a href="{{ $breadcrumb->url }}" class="hover:text-gray-700">
                                {{ $breadcrumb->title }}
                            </a>
                            <span class="mx-2 text-gray-400">/</span>
                        @else
                            <span class="text-gray-400">{{ $breadcrumb->title }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</section>
