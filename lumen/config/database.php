<?php

return  [
    'default' => 'mongodb',
    'migrations' => 'migrations',
    'connections' => [
        'mongodb' => array(
            'driver'   => 'mongodb',
            'dsn' => env('MONGODB_DSN', ''),
            'port'     => env('MONGODB_PORT', 27017),
            'database' => env('MONGODB_DATABASE', 'myFirstDatabase'),
            'options' => array(
                'db' => env('MONGODB_AUTHDATABASE', '') //Sets the auth DB
            )
        )
    ]
];