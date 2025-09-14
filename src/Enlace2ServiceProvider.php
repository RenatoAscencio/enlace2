<?php

namespace Enlace2\LaravelUrlShortener;

use Illuminate\Support\ServiceProvider;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;

class Enlace2ServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/enlace2.php', 'enlace2'
        );

        $this->app->singleton(Enlace2Client::class, function ($app) {
            return new Enlace2Client(
                $app['config']['enlace2.api_key'],
                $app['config']['enlace2.base_url']
            );
        });

        $this->app->alias(Enlace2Client::class, 'enlace2');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/enlace2.php' => config_path('enlace2.php'),
            ], 'enlace2-config');
        }
    }
}