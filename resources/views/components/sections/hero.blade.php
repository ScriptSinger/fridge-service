@props(['model', 'h1', 'subtitle'])

<section x-data="modalPhone()" class="text-gray-600 body-font">

    <div class="container mx-auto flex lg:flex-row flex-col lg:items-center px-5 py-10 md:py-24 md:pt-9">
        <div class="lg:max-w-lg lg:w-full mb-10 lg:mb-0">
            <img class="object-cover object-center rounded" src="{{ asset('assets/images/hero.png') }}"
                alt="Мастер по ремонту бытовой техники в Уфе">
        </div>
        <div class="lg:flex-grow lg:pl-24 flex flex-col md:text-left text-center">
            <h1 class="md:text-left title-font text-2xl sm:text-3xl lg:text-4xl mb-4 font-medium text-gray-900">
                {{ $model?->h1 ?? $h1 }}
            </h1>
            <p class="mb-8 leading-relaxed ">{{ $model?->subtitle ?? $subtitle }} </p>
            <div class="flex justify-center md:justify-start ">
                <button @click="openModal()"
                    class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer">Заказать
                    ремонт</button>
            </div>
        </div>
    </div>
    <x-ui.modal-phone x-ref="modal" :model="$model" />
</section>
