<?php

namespace Dream\Tests\Unit;

use Dream\Enums\Language;
use Dream\Facades\Dream;
use Dream\Tests\TestCase;

class DreamClientTest extends TestCase
{
    public function test_can_return_sentiment()
    {
        $sentiment = Dream::text('You did a great job!')->sentiment();

        $this->assertTrue($sentiment->disposition() === 'positive');
        $this->assertTrue($sentiment->positive());
    }

    public function test_can_return_key_phrases()
    {
        $this->assertTrue(Dream::text('You did an awesome great job!')->phrases()->count() === 2);
    }

    public function test_can_return_entities()
    {
        $entities = Dream::text('I have an appointment with Lloyd Christmas and Harry Dunne on December 16th.')
        ->entities();

        $this->assertTrue($entities->people()->count() === 2);
    }

    public function test_can_detect_language()
    {
        $this->assertTrue(Dream::text('This is an English sentence.')->language() === Language::ENGLISH);
    }

    public function test_can_detect_image_text()
    {
        $this->assertTrue(Dream::image('path/to/image.jpg')->text()->count() === 2);
    }

    public function test_can_detect_lables()
    {
        $this->assertTrue(Dream::image('path/to/image.jpg')->labels()->count() === 2);
    }
}
