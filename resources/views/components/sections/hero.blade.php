@props(['model', 'h1', 'subtitle', 'containerClass' => ''])

<section x-data="modalPhone()" class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center {{ $containerClass }} ">
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            {{-- <img src="{{ Storage::url($model->image) }}" alt="Мастер по ремонту бытовой техники в Уфе"> --}}
            <img src="{{ asset('assets/images/hero.png') }}" alt="Мастер по ремонту бытовой техники в Уфе">
        </div>
        <div
            class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
            <h1 class="title-font text-2xl sm:text-3xl lg:text-4xl mb-4 font-medium text-gray-900">{{ $h1 }}
            </h1>
            <p class="mb-8 leading-relaxed ">{{ $subtitle }} </p>
            <div class="flex justify-center">
                <button @click="openModal()"
                    class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg cursor-pointer">Заказать
                    ремонт</button>
            </div>
        </div>
    </div>
    <x-ui.modal-phone x-ref="modal" :model="$model" />
</section>
