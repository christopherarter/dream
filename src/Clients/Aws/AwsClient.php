<?php

namespace Dream\Clients\Aws;

use Dream\Clients\Client;
use Dream\Clients\ImageClient;
use Dream\Clients\TextClient;

class AwsClient extends Client
{
    public function image(string $image): ImageClient
    {
        return app(AwsImageClient::class, ['image' => $image]);
    }

    public function text(string $text): TextClient
    {
        return app(AwsTextClient::class, ['text' => $text]);
    }
}
