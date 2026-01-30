 <x-ui.sections.toggle-list :limit="6" :count="$services->count()">
     <div class="w-full overflow-auto">
         <table class="table-auto w-full text-left whitespace-no-wrap">
             <thead>
                 <tr>
                     <th class="px-4 py-3 bg-gray-100">Услуга</th>
                     <th class="px-4 py-3 bg-gray-100">Цена от</th>
                 </tr>
             </thead>

             <tbody>
                 @foreach ($services as $index => $service)
                     @php $price = $service->prices->first(); @endphp

                     <tr x-show="showAll || {{ $index }} < limit" x-cloak>
                         <td class="border-b-2 border-gray-200 px-4 py-3">
                             {{ $service->name }}
                         </td>
                         <td class="border-b-2 border-gray-200 px-4 py-3">
                             @if ($price && $price->price_from)
                                 от {{ number_format($price->price_from, 0, '.', ' ') }} {{ $price->units }}
                             @else
                                 по договорённости
                             @endif
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </x-ui.sections.toggle-list>
