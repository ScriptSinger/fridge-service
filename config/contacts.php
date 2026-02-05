<?php

return [

    'phone_display' => env('CONTACT_PHONE_DISPLAY', '+7 (919) 609-34-85'),
    'phone_tel' => env('CONTACT_PHONE_TEL', '+79196093485'),

    'address_full' => env(
        'CONTACT_ADDRESS_FULL',
        'ул. Мушникова, 11'
    ),

    'address_city' => env('CONTACT_ADDRESS_CITY', 'Уфа'),
    'address_country' => env('CONTACT_ADDRESS_COUNTRY', 'RU'),
    'area_served' => env('CONTACT_AREA_SERVED', 'Уфа'),

    'opening_hours_display' => env('CONTACT_OPENING_HOURS_DISPLAY', 'Пн–Вс 10:00–20:00'),
];
