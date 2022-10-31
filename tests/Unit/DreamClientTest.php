<?php

namespace Dream\Tests\Unit;

use Dream\Collections\TextEntityCollection;
use Dream\Enums\TextEntityType;
use Dream\Facades\Dream;
use Dream\KeyPhrase;
use Dream\Sentiment;
use Dream\Tests\TestCase;
use Dream\TextEntity;

class DreamClientTest extends TestCase
{
    public function test_can_return_sentiment()
    {
        Dream::shouldReceive('sentiment')
            ->once()
            ->andReturn(new Sentiment(0.9888, 0.0112, 0.001));

        $sentiment = Dream::sentiment('You did a great job!');

        $this->assertTrue($sentiment->disposition() === 'positive');
        $this->assertTrue($sentiment->positive());
    }

    public function test_can_return_key_phrases()
    {
        Dream::shouldReceive('keyPhrases')
            ->once()
            ->andReturn(collect([
                new KeyPhrase('great job', 0.9888),
                new KeyPhrase('awesome', 0.75),
            ]));

        $this->assertTrue(Dream::keyPhrases('You did an awesome great job!')->count() === 2);
    }

    public function test_can_return_entities()
    {
        Dream::shouldReceive('entities')
            ->once()
            ->andReturn(new TextEntityCollection([
                new TextEntity('Lloyd Christmas', TextEntityType::PERSON, 0.97),
                new TextEntity('Harry Dunne', TextEntityType::PERSON, 0.96),
                new TextEntity('December 16th', TextEntityType::DATE, 0.95),
            ]));

        $entites = Dream::entities('I have an appointment with Lloyd Christmas and Harry Dunne on December 16th.');

        $this->assertTrue($entites->people()->count() === 2);
    }
}
