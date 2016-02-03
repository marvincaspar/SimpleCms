<?php

namespace Mc388\SimpleCms;

use Illuminate\Support\ServiceProvider;

/**
 * Class SimpleCmsServiceProvider
 *
 * @package Mc388\SimpleCms
 */
class SimpleCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mc388-simple-cms');

        $this->publishes([
            __DIR__ . '/public/' => public_path('simple-cms'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/app/routes.php';
    }
}
