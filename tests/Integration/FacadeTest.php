<?php

namespace Enlace2\LaravelUrlShortener\Tests\Integration;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Enlace2\LaravelUrlShortener\Services\LinkService;

class FacadeTest extends TestCase
{
    public function test_facade_can_access_links_service()
    {
        $service = Enlace2::links();

        $this->assertInstanceOf(LinkService::class, $service);
    }

    public function test_facade_is_registered()
    {
        $aliases = $this->app->make('config')->get('app.aliases', []);

        $this->assertTrue(class_exists(Enlace2::class));
    }

    protected function getPackageAliases($app)
    {
        return [
            'Enlace2' => Enlace2::class,
        ];
    }
}