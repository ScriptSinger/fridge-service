<x-layouts.app :title="$page->title" :description="$page->description">
    <x-ui.breadcrumbs :route="$breadcrumbRoute" :model="null" />

    <section class="bg-white">
        <div class="container mx-auto px-5 py-10 md:py-14">
            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm md:p-8">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
                    <div>

                        <h1 class="mt-2 text-2xl font-bold text-slate-900 md:text-3xl">{{ $page->h1 }}</h1>
                        @if (!empty($page->subtitle))
                            <p class="mt-2 text-sm text-slate-600 md:text-base">{{ $page->subtitle }}</p>
                        @endif
                    </div>

                    <span
                        class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                        Обновлено: {{ optional($page->updated_at)->format('d.m.Y') }}
                    </span>
                </div>

                @php
                    $content = trim((string) ($page->content ?? ''));
                    $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                @endphp

                <div
                    class="prose prose-slate max-w-none [&_ul]:list-disc [&_ol]:list-decimal [&_ul]:pl-6 [&_ol]:pl-6 [&_ul]:my-3 [&_ol]:my-3 [&_li]:my-1">
                    @if ($content !== '')
                        {!! $content !!}
                    @else
                        {!! nl2br(e((string) ($page->description ?? ''))) !!}
                    @endif
                </div>
            </div>
        </div>
    </section>

    <x-ui.scroll-up />
</x-layouts.app>
