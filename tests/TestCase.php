<?php

namespace Dream\Tests;

use Dream\DreamServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected $enablesPackageDiscoveries = true;

    protected function defineEnvironment($app)
    {
        $app['config']->set('dream.default', 'test');
    }

    protected function getPackageProviders($app): array
    {
        return [
            DreamServiceProvider::class,
        ];
    }
}
