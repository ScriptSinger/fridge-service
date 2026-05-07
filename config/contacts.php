<?php

return [

    'phone_display' => env('CONTACT_PHONE_DISPLAY', '+7 (919) 609-34-85'),
    'phone_tel' => env('CONTACT_PHONE_TEL', '+79196093485'),
    'email' => env('CONTACT_EMAIL', 'ufamasters102@gmail.com'),
    'telegram_url' => env('CONTACT_TELEGRAM_URL', 'https://t.me/heturion'),
    'whatsapp_tel' => env('CONTACT_WHATSAPP_TEL'),

    'address_full' => env(
        'CONTACT_ADDRESS_FULL',
        'ул. Рихарда Зорге, 63'
    ),

    'address_city' => env('CONTACT_ADDRESS_CITY', 'Уфа'),
    'address_country' => env('CONTACT_ADDRESS_COUNTRY', 'RU'),
    'area_served' => env('CONTACT_AREA_SERVED', 'Уфа и пригород'),

    'opening_hours_display' => env('CONTACT_OPENING_HOURS_DISPLAY', 'Пн–Вс 10:00–20:00'),
];
