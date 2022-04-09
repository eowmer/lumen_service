<?php
 
 return [
     'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'agent' => [
            'driver' => 'session',
            'provider' => 'agents',
        ]

    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ]
    ],
 ]

 ?>