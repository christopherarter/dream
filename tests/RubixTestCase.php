<?php

namespace Dream\Tests;

use Dream\DreamServiceProvider;

class RubixTestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected $enablesPackageDiscoveries = true;

    protected function defineEnvironment($app)
    {
        $app['config']->set('dream.default', 'rubix');
        $app['config']->set('dream.connections.rubix.models.sentiment', 'tests/Rubix/sentiment.rbx');
    }

    protected function getPackageProviders($app): array
    {
        return [
            DreamServiceProvider::class,
        ];
    }
}
