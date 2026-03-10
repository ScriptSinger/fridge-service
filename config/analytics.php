<?php

return [
    'yandex_metrika' => env('YANDEX_METRIKA_ID'),
    'exclude_ips' => array_filter(explode(',', env('YANDEX_METRIKA_EXCLUDE_IPS', ''))),
    'opt_out_cookie' => env('ANALYTICS_OPT_OUT_COOKIE', 'disable_analytics'),
];
