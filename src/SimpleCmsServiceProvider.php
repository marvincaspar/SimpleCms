<?php

namespace Mc388\SimpleCms;

use Illuminate\Support\ServiceProvider;
use Mc388\SimpleCms\App\Models\Contact;
use Mc388\SimpleCms\App\Models\Setting;

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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'simple-cms');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'simple-cms');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/public/' => public_path('simple-cms'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/config' => config_path(),
        ], 'config');

        // Add the followin parameter to the site layout:
        // - contact
        // - settings
        app('view')->composer('simple-cms::layouts.site', function ($view) {
            $contact = Contact::firstOrCreate([]);
            $settings = Setting::firstOrCreate([]);

            $view->with(compact('contact', 'settings'));
        });

        // Add the followin parameter to the admin layout:
        // - controller
        // - settings
        app('view')->composer('simple-cms::layouts.admin', function ($view) {
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            list($controller, $action) = explode('@', $controller);

            $contact = Contact::firstOrCreate([]);
            $settings = Setting::firstOrCreate([]);

            $view->with(compact('contact', 'controller', 'settings'));
        });
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
