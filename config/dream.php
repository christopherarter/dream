<?php

use Dream\Clients\Aws\DreamAwsClient;

return [

    'default' => env('DREAM_CONNECTION', 'aws'),

    'connections' => [
        'aws' => [
            'driver' => DreamAwsClient::class,
            'key' => env('DREAM_AWS_ACCESS_KEY_ID') ?? env('AWS_ACCESS_KEY_ID'),
            'secret' => env('DREAM_AWS_SECRET_ACCESS_KEY') ?? env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('DREAM_AWS_DEFAULT_REGION') ?? env('AWS_DEFAULT_REGION'),
        ],
    ],

    'default_language' => 'en',
];
