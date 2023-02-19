<?php

namespace Dream\Tests\Feature;

use Dream\Tests\TestCase;

class OpenAIClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('dream.default', 'openai');
    }

    public function test_can_return_sentiment()
    {
        $sentiment = app('dream')->text('You did a great job!')->sentiment();

        $this->assertTrue($sentiment->disposition() === 'positive');
        $this->assertTrue($sentiment->positive());
    }

    public function test_can_return_language()
    {
        $language = app('dream')->text('please do not let this test distract you from the fact that in 1998, The Undertaker threw Mankind off Hell In A Cell, and plummeted 16 ft through an announcer’s table.')
            ->language();
        $this->assertTrue($language->value === 'en');
    }

    public function test_can_return_entities()
    {
        $entities = app('dream')->text('Michael Keaton, Christian Bale, and Ben Affleck have all played Batman.')
            ->entities()
            ->people();

        $this->assertTrue($entities->count() === 3);
    }
}
