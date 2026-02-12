@props(['galleries'])

@if ($galleries->isNotEmpty())
    <x-ui.sections.wrapper>
        <x-ui.sections.header title="Примеры выполненных работ"
            subtitle="Реальные кейсы и типовые задачи, которые мы решаем" />

        <x-ui.sections.toggle-list :limit="6" :count="$galleries->whereNotNull('image')->count()">
            <div class="flex flex-wrap -m-4">
                @foreach ($galleries as $index => $gallery)
                    @continue(!$gallery->image)
                    <div class="lg:w-1/3 sm:w-1/2 p-4" x-show="showAll || {{ $index }} < limit" x-cloak>
                        <div class="flex relative h-full aspect-[5/3]">
                            <img alt="{{ $gallery->image_alt ?: $gallery->title }}"
                                class="absolute inset-0 w-full h-full object-cover object-center"
                                src="{{ asset('storage/' . $gallery->image) }}">
                            <div
                                class="px-8 py-10 relative z-10 w-full h-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                <h2 class="tracking-widest text-sm title-font font-medium text-yellow-500 mb-1">
                                    {{ $gallery->subtitle }}
                                </h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $gallery->title }}
                                </h1>
                                <p class="leading-relaxed">{{ $gallery->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.sections.toggle-list>
    </x-ui.sections.wrapper>
@endif
