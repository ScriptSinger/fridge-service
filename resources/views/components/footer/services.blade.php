 <div class="mb-10">
     <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">Наши услуги</h2>
     <ul class="list-none">
         @foreach ($services as $service)
             <li class="mb-2">
                 <a href="#" class="text-gray-600 hover:text-gray-800">
                     {{ $service->title }}
                 </a>
             </li>
         @endforeach
     </ul>
 </div>
