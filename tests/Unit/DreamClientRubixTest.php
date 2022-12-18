<?php

namespace Dream\Tests\Unit;

use Dream\Enums\Language;
use Dream\Facades\Dream;
use Dream\Tests\RubixTestCase;
use Dream\Exceptions\DreamDriverMethodNotDefinedException;

class DreamClientRubixTest extends RubixTestCase
{
    public function test_can_return_sentiment()
    {
        $sentiment = Dream::text('This is an excellent job and we are all very pleased.')->sentiment();

        $this->assertTrue($sentiment->disposition() === 'positive');
        $this->assertTrue($sentiment->positive());
    }

    public function test_cannot_return_key_phrases()
    {
        $this->expectException(DreamDriverMethodNotDefinedException::class);

        $this->assertTrue(Dream::text('You did an awesome great job!')->phrases()->count() === 2);
    }

    public function test_cannot_return_entities()
    {
        $this->expectException(DreamDriverMethodNotDefinedException::class);
        
        $entities = Dream::text('I have an appointment with Lloyd Christmas and Harry Dunne on December 16th.')
        ->entities();

        $this->assertTrue($entities->people()->count() === 2);
    }

    public function test_cannot_detect_language()
    {
        $this->expectException(DreamDriverMethodNotDefinedException::class);
        
        $this->assertTrue(Dream::text('This is an English sentence.')->language() === Language::ENGLISH);
    }

    public function test_cannot_detect_image_text()
    {
        $this->expectException(DreamDriverMethodNotDefinedException::class);
        
        $this->assertTrue(Dream::image('path/to/image.jpg')->text()->count() === 2);
    }

    public function test_cannot_detect_lables()
    {
        $this->expectException(DreamDriverMethodNotDefinedException::class);
        
        $this->assertTrue(Dream::image('path/to/image.jpg')->labels()->count() === 2);
    }
}
