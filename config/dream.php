<?php

use Dream\Clients\Aws\AwsClient;

return [

    'default' => env('DREAM_CONNECTION', 'aws'),

    'connections' => [
        'aws' => [
            'driver' => AwsClient::class,
            'key' => env('DREAM_AWS_ACCESS_KEY_ID') ?? env('AWS_ACCESS_KEY_ID'),
            'secret' => env('DREAM_AWS_SECRET_ACCESS_KEY') ?? env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('DREAM_AWS_DEFAULT_REGION') ?? env('AWS_DEFAULT_REGION'),
        ],
        'openai' => [
            'driver' => \Dream\Clients\OpenAI\OpenAIClient::class,
            'key' => env('DREAM_OPENAI_API_KEY'),
        ],
        'test' => [
            'driver' => \Dream\Tests\Fixtures\TestClient::class,
        ],
    ],

    'default_language' => 'en',
];
