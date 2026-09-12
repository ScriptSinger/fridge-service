 <x-ui.sections.toggle-list :limit="4" :count="$services->count()">
     <div class="divide-y">
         @foreach ($services as $index => $service)
             @php $price = $service->preferredPrice($service->device_id, $brand->id ?? null); @endphp

             <div class="py-3" x-show="showAll || {{ $index }} < limit" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1">
                <a href="{{ route('services.show', [$service->device, $service->slug]) }}"
                    class="flex items-center justify-between gap-3 hover:text-yellow-600">
                    <span class="font-medium text-gray-900">{{ $service->name }}</span>
                    <span class="shrink-0 text-sm text-gray-600">
                        {{ $price?->price_from ? 'от ' . number_format($price->price_from, 0, '.', ' ') . ' ₽' : 'по договорённости' }}
                    </span>
                </a>
             </div>
         @endforeach
     </div>
 </x-ui.sections.toggle-list>
