 <x-ui.sections.toggle-list :limit="4" :count="$services->count()">
     <div class="divide-y">
         @foreach ($services as $index => $service)
             @php $price = $service->prices->first(); @endphp

             <div class="py-3" x-show="showAll || {{ $index }} < limit" x-cloak>
                 <div class="font-medium">{{ $service->name }}</div>

                 @if ($service->description)
                     <div class="text-sm text-gray-500">
                         {{ $service->description }}
                     </div>
                 @endif

                 <div class="text-sm mt-1">
                     {{ $price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ₽' : ' ' }}
                 </div>
             </div>
         @endforeach
     </div>
 </x-ui.sections.toggle-list>
