 <x-ui.sections.wrapper>

     <x-ui.sections.header title="История компании"
         subtitle="Путь развития сервиса от небольшой мастерской до современной сервисной компании" />

     @php
         $items = [
             [
                 'year' => '2008',
                 'title' => 'Основание мастерской',
                 'description' =>
                     'Начали работу как небольшая частная мастерская по ремонту холодильников и стиральных машин. С самого начала сделали ставку на честную диагностику и аккуратную работу.',
             ],
             [
                 'year' => '2012',
                 'title' => 'Выездной ремонт по городу',
                 'description' =>
                     'Организовали выезд мастеров на дом. Это позволило сократить сроки ремонта и сделать сервис удобнее для клиентов.',
             ],
             [
                 'year' => '2016',
                 'title' => 'Углублённая диагностика электроники',
                 'description' =>
                     'Освоили ремонт модулей управления и сложной электроники. Начали выполнять компонентный ремонт без полной замены дорогостоящих узлов.',
             ],
             [
                 'year' => '2020',
                 'title' => 'Стандарты качества и гарантия',
                 'description' =>
                     'Внедрили внутренние регламенты диагностики и контроля качества. Расширили гарантию на выполненные работы до 12 месяцев.',
             ],
             [
                 'year' => 'Сегодня',
                 'title' => 'Развитие и автоматизация',
                 'description' =>
                     'Автоматизировали приём заявок, внедрили CRM и продолжаем расширять команду специалистов.',
             ],
         ];
     @endphp

     <div class="flex flex-wrap w-full">

         {{-- Левая колонка — timeline --}}
         <div class="lg:w-2/5 md:w-1/2 md:pr-10 md:py-6">

             @foreach ($items as $item)
                 <div class="flex relative {{ !$loop->last ? 'pb-12' : '' }}">

                     @if (!$loop->last)
                         <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                             <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                         </div>
                     @endif

                     {{-- Кружок с годом --}}
                     <div
                         class="flex-shrink-0 w-10 h-10 rounded-full bg-yellow-500 inline-flex items-center justify-center text-white relative z-10 text-xs font-semibold">
                         {{ is_numeric($item['year']) ? substr($item['year'], -2) : '•' }}
                     </div>

                     {{-- Контент --}}
                     <div class="flex-grow pl-4">
                         <h3 class="font-semibold text-gray-900 mb-1">
                             {{ $item['year'] }} — {{ $item['title'] }}
                         </h3>
                         <p class="leading-relaxed text-gray-600 text-sm">
                             {{ $item['description'] }}
                         </p>
                     </div>

                 </div>
             @endforeach

         </div>

         {{-- Правая колонка — изображение --}}
         <img class="lg:w-3/5 md:w-1/2 object-cover object-center rounded-2xl md:mt-0 mt-12 shadow-sm"
             src="{{ asset('assets/images/about/history.png') }}" alt="История компании">

     </div>

 </x-ui.sections.wrapper>
