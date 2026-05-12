@php
    $siteUrl = rtrim(config('app.url', 'https://service.ufamasters.ru'), '/');

    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'ApplianceRepair',
        'name' => 'РемБытТехника',
        'url' => $siteUrl,
        'logo' => $siteUrl . '/assets/images/logo.png',
        'image' => $siteUrl . '/assets/images/hero.webp',
        'telephone' => config('contacts.phone_tel'),
        'email' => config('contacts.email'),
        'priceRange' => '₽₽',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => config('contacts.address_full'),
            'addressLocality' => config('contacts.address_city'),
            'addressRegion' => 'Республика Башкортостан',
            'postalCode' => '450075',
            'addressCountry' => config('contacts.address_country', 'RU'),
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 54.768661,
            'longitude' => 56.009645,
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => config('contacts.area_served'),
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ],
            'opens' => '10:00',
            'closes' => '20:00',
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Услуги ремонта бытовой техники',
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
        'sameAs' => [
            'https://yandex.com/profile/15669269436',
            'https://vk.com/rbtufa2016',
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
