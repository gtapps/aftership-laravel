<?php

namespace Gtapps\AfterShipLaravel;

use Illuminate\Support\ServiceProvider;

class AftershipServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        include __DIR__ . '/routes.php';
        
        $this->publishes([
            __DIR__.'/../config/aftership-laravel.php' => config_path('aftership-laravel.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__.'/../config/aftership-laravel.php', 'aftership-laravel');
        $this->app->singleton('aftership-laravel', function() {
            return new Aftership();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['aftership-laravel'];
    }

}
