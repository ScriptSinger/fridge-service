 <?php
     $jsonld = [
         '@context' => 'https://schema.org',
         '@type' => 'LocalBusiness',
         'name' => config('app.name'),
         'image' => rtrim(config('app.url'), '/') . '/assets/images/hero.png',
         'url' => config('app.url'),

         // ВАЖНО: только tel-формат
         'telephone' => config('contacts.phone_tel'),

         'priceRange' => '500-5000 RUB',

         'address' => [
             '@type' => 'PostalAddress',
             'streetAddress' => config('contacts.address_full'),
             'addressLocality' => config('contacts.address_city'),
             'addressCountry' => config('contacts.address_country'),
         ],

         // ВАЖНО: не строка, а объект
         'areaServed' => [
             '@type' => 'City',
             'name' => config('contacts.area_served'),
         ],

         // ВАЖНО: новый формат вместо openingHours
         'openingHoursSpecification' => [
             '@type' => 'OpeningHoursSpecification',
             'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
             'opens' => '10:00',
             'closes' => '20:00',
         ],

         // ВАЖНО: вместо availableService
         'hasOfferCatalog' => [
             '@type' => 'OfferCatalog',
             'name' => 'Услуги ремонта',
             'itemListElement' => [
                 [
                     '@type' => 'Offer',
                     'itemOffered' => [
                         '@type' => 'Service',
                         'name' => 'Ремонт холодильников',
                     ],
                 ],
                 [
                     '@type' => 'Offer',
                     'itemOffered' => [
                         '@type' => 'Service',
                         'name' => 'Ремонт стиральных машин',
                     ],
                 ],
                 [
                     '@type' => 'Offer',
                     'itemOffered' => [
                         '@type' => 'Service',
                         'name' => 'Ремонт другой бытовой техники',
                     ],
                 ],
             ],
         ],
     ];
 ?>

 <script type="application/ld+json">
<?php echo json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>

</script>
<?php /**PATH /var/www/html/resources/views/components/seo/jsonld.blade.php ENDPATH**/ ?>