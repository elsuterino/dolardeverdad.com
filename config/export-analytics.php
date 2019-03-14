<?php

return [
    'domain' => 'dolardeverdad.com',

    'redis_key' => 'dolardeverdad.access_logs',

    'influx' => [
        'host' => 'localhost',
        'port' => 8086,
        'database' => 'website_tracker',
        'series' => 'access'
    ]
];