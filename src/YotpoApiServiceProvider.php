<?php

namespace EolabsIo\YotpoApi;

use EolabsIo\YotpoApi\Yotpo;
use Illuminate\Support\ServiceProvider;
use EolabsIo\YotpoApi\Domain\Storefront\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Providers\EventServiceProvider as ReviewEventServiceProvider;

class YotpoApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (Yotpo::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/yotpo'),
            ], 'yotpo-migrations');

            $this->publishes([
                __DIR__.'/../config/yotpo.php' => config_path('yotpo.php'),
            ], 'yotpo-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(ReviewEventServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/yotpo.php', 'yotpo');

        // Register the main class to use with the facade
        $this->app->singleton('yotpo-api-review', function () {
            return new Review;
        });
    }
}
