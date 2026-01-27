 <div class="mb-10">
     <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Наши услуги</h2>
     <ul class="list-none">
         @foreach ($devices as $device)
             @continue(!$device->slug)
             <li class="mb-2">
                 <a href="{{ route('devices.show', $device->slug) }}" class="text-gray-600 hover:text-gray-800">
                     {{ $device->permalink }}
                 </a>
             </li>
         @endforeach
     </ul>
 </div>
