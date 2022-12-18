<?php

namespace Dream\Clients\Rubix;

use Dream\Clients\Client;
use Dream\Clients\ImageClient;
use Dream\Clients\TextClient;

class RubixClient extends Client
{
    public function image(string $image): ImageClient
    {
        return app(ImageClient::class, ['image' => $image]);
    }

    public function text(string $text): TextClient
    {
        return app(RubixTextClient::class, ['text' => $text]);
    }
}
