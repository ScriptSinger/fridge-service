 <x-ui.sections.wrapper id="contact" class="relative">
     <div class="flex sm:flex-nowrap flex-wrap">
         <div
             class="w-full lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 relative h-64 sm:h-auto">

             <iframe class="absolute inset-0 w-full h-full" frameborder="0" title="map" marginheight="0" marginwidth="0"
                 scrolling="no"
                 src="https://yandex.ru/map-widget/v1/?ll=56.010745%2C54.769579&z=16&pt=56.010745,54.769579,pm2rdm"
                 allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
             </iframe>
         </div>

         <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
             <x-forms.leads class="w-full" :model="$model" idPrefix="contact" title="Получить консультацию"
                subtitle="Оставьте контакты, и мы бесплатно проконсультируем вас в ближайшее время." />
         </div>
     </div>
 </x-ui.sections.wrapper>
