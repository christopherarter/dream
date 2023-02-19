<?php

namespace Dream\Clients\OpenAI;

use Dream\Clients\Client;
use Dream\Clients\TextClient;

class OpenAIClient extends Client
{
    public function text(string $text): TextClient
    {
        return app(OpenAITextClient::class, ['text' => $text]);
    }
}
