<?php

namespace Dream;

use Dream\Clients\Client as Dream;
use Dream\Facades\Dream as DreamFacade;
use Illuminate\Support\ServiceProvider;

class DreamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dream.php' => config_path('dream.php'),
        ], 'dream-config');

        /**
         * Macros
         */
        DreamFacade::macro('prompt', function ($text) {
            return app('dream')->text($text)->prompt();
        });

        DreamFacade::macro('sentiment', function ($text) {
            return app('dream')->text($text)->sentiment();
        });

        DreamFacade::macro('entities', function ($text) {
            return app('dream')->text($text)->entities();
        });

        DreamFacade::macro('phrases', function ($text) {
            return app('dream')->text($text)->phrases();
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/dream.php', 'dream');
        $this->app->bind('dream', function () {
            return Dream::connection(config('dream.default'));
        });
    }
}
