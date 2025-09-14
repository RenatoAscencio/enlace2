<?php

namespace Enlace2\LaravelUrlShortener\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Enlace2\LaravelUrlShortener\Enlace2ServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            Enlace2ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('enlace2.api_key', 'test-api-key');
        $app['config']->set('enlace2.base_url', 'https://enlace2.com/api/');
    }
}