 <x-ui.sections.wrapper id="contact" class="relative">
     <div class="flex sm:flex-nowrap flex-wrap">
         <div
             class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">

             <iframe class="absolute inset-0 w-full h-full" frameborder="0" title="map" marginheight="0" marginwidth="0"
                 scrolling="no"
                 src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1540.771020021799!2d56.115043209886295!3d54.77974630766362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2suk!4v1767811688709!5m2!1sru!2suk"
                 allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                 style="filter: grayscale(1) contrast(1.2) opacity(0.4);">
             </iframe>

             <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md w-full">
                 <div class="lg:w-1/2 px-6">
                     <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">
                         Адрес
                     </h2>
                     <p class="mt-1">
                         {{ config('contacts.address_full') }}
                     </p>
                 </div>

                 <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                     <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">
                         Телефон
                     </h2>
                     <p class="leading-relaxed">
                         <x-ui.phone class="mt-2 text-gray-900 hover:text-yellow-600" />
                     </p>
                 </div>
             </div>
         </div>

         <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
             <x-forms.leads class="w-full" :model="$model" idPrefix="contact" />
         </div>
     </div>
 </x-ui.sections.wrapper>
