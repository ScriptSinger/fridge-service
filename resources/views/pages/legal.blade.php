<x-layouts.app :title="$page->title" :description="$page->description" :noindex="true">
    <x-ui.breadcrumbs :route="$breadcrumbRoute" :model="null" />

    <x-ui.sections.wrapper>
        <div class="mx-auto max-w-5xl rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-sm md:p-8">

            <x-ui.sections.header title="{{ $page->h1 }}" subtitle="{{ $page->subtitle }}" />
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
    </x-ui.sections.wrapper>

    <x-ui.scroll-up />

</x-layouts.app>
