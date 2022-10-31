<?php

namespace Dream\Tests;

use Dream\DreamServiceProvider;
use Dream\Tests\Fixtures\TestClient;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected $enablesPackageDiscoveries = true;

    protected function defineEnvironment($app)
    {
        $app['config']->set('dream.connections.aws.driver', TestClient::class);
    }

    protected function getPackageProviders($app): array
    {
        return [
            DreamServiceProvider::class,
        ];
    }
}
