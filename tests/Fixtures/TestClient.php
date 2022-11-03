<?php

namespace Dream\Tests\Fixtures;

class TestClient extends \Dream\Clients\Client
{
    public function image(string $image): TestImageClient
    {
        return app(TestImageClient::class, ['image' => $image]);
    }

    public function text(string $text): TestTextClient
    {
        return app(TestTextClient::class, ['text' => $text]);
    }
}
