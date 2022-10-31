<?php

namespace Dream;

use Aws\Comprehend\ComprehendClient;
use Dream\Clients\Aws\DreamAwsClient;
use Dream\Clients\Client as Dream;
use Illuminate\Support\ServiceProvider;

class DreamServiceProvider extends ServiceProvider
{
    /**
     * Registers a specific singleton instance of AWS Client
     * for Dream.
     *
     * @return void
     */
    protected function aws(): void
    {
        $this->app->when(DreamAwsClient::class)
            ->needs(ComprehendClient::class)
            ->give(function () {
                return new ComprehendClient([
                    'region' => config('dream.connections.aws.region'),
                    'version' => 'latest',
                ]);
            });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dream.php' => config_path('dream.php'),
        ], 'dream-config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/dream.php', 'dream');
        $this->aws();
        $this->app->bind('dream', function () {
            return Dream::connection(config('dream.default'));
        });
    }
}
