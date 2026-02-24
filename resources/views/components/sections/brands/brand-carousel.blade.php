 @props(['brands'])

 @php
     $slides = collect($brands)
         ->filter(fn($b) => !empty($b->image))
         ->map(
             fn($b) => [
                 'name' => $b->name,
                 'image' => $b->image_url,
                 'image_alt' => $b->image_alt ?? $b->name,
             ],
         )
         ->values();
 @endphp

 @if ($slides->isNotEmpty())
     <x-ui.sections.wrapper>
         <x-ui.sections.header title="Бренды которые мы обслуживаем" />

         <div class="mx-auto w-full overflow-hidden" x-data="brandCarousel(@js($slides->all()), 0.5)" x-init="init()"
             @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
             <div class="flex w-max" :style="translateX()">
                 <template x-for="(slide, index) in slides" :key="index">
                     <div class="shrink-0 flex items-center justify-center p-4">
                         <img :src="slide.image" :alt="slide.image_alt" class="h-16 md:h-20 object-contain">
                     </div>
                 </template>
             </div>
         </div>
         </div>
     </x-ui.sections.wrapper>
 @endif
