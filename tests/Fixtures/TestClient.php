<?php

namespace Dream\Tests\Fixtures;

use Dream\Sentiment;

class TestClient extends \Dream\Clients\Client
{
    public function sentiment(string $text, string $language = null): Sentiment
    {
        return new Sentiment(0.9888, 0.0112, 0.001);
    }
}
