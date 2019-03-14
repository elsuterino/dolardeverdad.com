<?php

return [
    'tracker' => [
        //applied to field in database
        'domain' => 'dolardeverdad.com',
        //applied to redis key in redis db
        'redis_key' => 'dolardeverdad.access_logs',
        //influxdb configuration
        'influx' => [
            'host' => 'localhost',
            'port' => 8086,
            'database' => 'website_tracker',
            'series' => 'access'
        ]
    ]
];