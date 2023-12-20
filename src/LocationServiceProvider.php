<?php

namespace Buqiu\MobileLocation;

use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    protected string $configPath = __DIR__."/../config/location.php";

    public function boot(): void
    {
        $this->publishes([
            $this->configPath => config_path('location.php'),
        ], 'location');
    }

    public function register(): void
    {
        $this->app->singleton('location', function ($app) {
            return new LocationService();
        });

        $this->mergeConfigFrom(
            $this->configPath,
            'location'
        );
    }
}