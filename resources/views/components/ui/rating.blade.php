 @props(['rating' => 0, 'size' => 4])

 @php
     $starPrefix = 'star-' . uniqid();
 @endphp

 <div class="flex gap-1 text-yellow-500">
     @for ($i = 1; $i <= 5; $i++)
         @php
             $fill = max(min($rating - ($i - 1), 1), 0);
             $percent = (int) round($fill * 100);
         @endphp
         <svg viewBox="0 0 24 24" class="w-{{ $size }} h-{{ $size }}">
             <defs>
                 <clipPath id="{{ $starPrefix }}-clip-{{ $i }}">
                     <rect width="{{ $percent }}%" height="24" />
                 </clipPath>
             </defs>
             <path fill="#E5E7EB" d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
             <path fill="currentColor" clip-path="url(#{{ $starPrefix }}-clip-{{ $i }})"
                 d="M12 3.5l2.5 5.1 5.6.8-4 3.9.9 5.6L12 16.8l-5 2.6.9-5.6-4-3.9 5.6-.8Z" />
         </svg>
     @endfor
 </div>
