@props(['problems'])

<x-ui.section id="blog">
    <div class="flex flex-col">
        <div class="h-1 bg-gray-200 rounded overflow-hidden">
            <div class="w-24 h-full bg-yellow-500"></div>
        </div>
        <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Частые неисправности
                бытовой техники
            </h2>
            <p class="lg:w-2/3 leading-relaxed text-base">Мы собрали самые распространённые поломки
                бытовой техники, с которыми
                к нам обращаются клиенты. Для каждой проблемы указаны симптомы,
                причины и возможные способы ремонта.</p>
        </div>
    </div>

    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
        @foreach ($problems as $problem)
            <a href="" class="p-4 md:w-1/3 sm:mb-0 mb-6 block">

                <div class="rounded-lg h-64 overflow-hidden">
                    <img alt="content" class="object-cover object-center h-full w-full"
                        src="https://dummyimage.com/1203x503">
                </div>
                <h3 class="text-xl font-medium title-font text-gray-900 mt-5">{{ $problem->h1 }}</h3>
                <p class="text-base leading-relaxed mt-2">
                    <p>{{ $problem->short_content }}</p>
            </a>
        @endforeach
    </div>

    <div class="  mt-8">
        <a href="/problems"
            class="inline-block bg-yellow-500 text-white py-3 px-6 rounded hover:bg-yellow-600 transition">
            Смотреть все проблемы →
        </a>
    </div>
</x-ui.section>
