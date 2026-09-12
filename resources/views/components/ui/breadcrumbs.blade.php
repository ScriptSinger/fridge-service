<section class="bg-white">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center text-sm">
        <div class="relative w-full min-w-0" x-data="breadcrumbScroll()">
            <nav aria-label="breadcrumb" x-ref="nav" tabindex="0" class="w-full overflow-x-auto">
                <ol class="flex items-center space-x-1 whitespace-nowrap text-gray-500">
                    @php
                        $breadcrumbs = $route ? Breadcrumbs::generate($route, $model) : Breadcrumbs::current();
                    @endphp

                    @if ($breadcrumbs->isNotEmpty())
                        <script type="application/ld+json">{!! \App\Support\Seo\BreadcrumbJsonLd::make($breadcrumbs) !!}</script>
                    @endif

                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="flex items-center">
                            @if ($breadcrumb->url && !$loop->last)
                                <a href="{{ $breadcrumb->url }}" class="hover:text-gray-700">
                                    {{ $breadcrumb->title }}
                                </a>
                                <span class="mx-2 text-gray-400">/</span>
                            @else
                                <span class="text-gray-400" aria-current="page">{{ $breadcrumb->title }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>

            <div x-show="canScrollRight" x-cloak aria-hidden="true"
                class="pointer-events-none absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-white to-transparent">
            </div>
        </div>
    </div>
</section>
