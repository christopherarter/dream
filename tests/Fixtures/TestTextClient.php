<?php

namespace Dream\Tests\Fixtures;

use Dream\Clients\TextClient;
use Dream\Collections\TextCollection;
use Dream\Collections\TextEntityCollection;
use Dream\Entities\Sentiment;
use Dream\Entities\Text;
use Dream\Entities\TextEntity;
use Dream\Enums\Language;
use Dream\Enums\TextEntityType;

class TestTextClient extends TextClient
{
    public function sentiment(): Sentiment
    {
        return new Sentiment(0.9888, 0.0112, 0.001);
    }

    public function language(): Language
    {
        return Language::ENGLISH;
    }

    public function phrases(): TextCollection
    {
        return new TextCollection([
            new Text('awesome', 0.99),
            new Text('great', 0.98),
        ]);
    }

    public function entities(): TextEntityCollection
    {
        return new TextEntityCollection([
            new TextEntity('Lloyd Christmas', 0.97, TextEntityType::PERSON),
            new TextEntity('Harry Dunne', 0.96, TextEntityType::PERSON),
            new TextEntity('December 16th', 0.95, TextEntityType::DATE),
        ]);
    }
}
