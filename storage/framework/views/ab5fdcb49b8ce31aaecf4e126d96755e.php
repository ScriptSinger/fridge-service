<?php
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Рембыттехника',
        'image' => 'https://site.ru/path/to/hero.png',
        'telephone' => config('contacts.phone_display'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => config('contacts.address_city'),
            'addressCountry' => config('contacts.address_country'),
        ],
        'areaServed' => config('contacts.area_served'),
        'url' => 'https://site.ru/',
        'openingHours' => config('contacts.opening_hours_schema'),
        'priceRange' => 'от 500 ₽',
        'availableService' => [
            [
                '@type' => 'Service',
                'name' => 'Ремонт холодильников',
            ],
            [
                '@type' => 'Service',
                'name' => 'Ремонт стиральных машин',
            ],
            [
                '@type' => 'Service',
                'name' => 'Ремонт другой бытовой техники',
            ],
        ],
    ];
?>
<script type="application/ld+json">
<?php echo json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>

</script>
<?php /**PATH /var/www/html/resources/views/components/seo/jsonld.blade.php ENDPATH**/ ?>