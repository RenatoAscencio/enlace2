<?php

namespace Enlace2\LaravelUrlShortener\Tests\Integration;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Enlace2ServiceProvider;

class ServiceProviderTest extends TestCase
{
    public function test_service_provider_registers_client()
    {
        $this->assertTrue($this->app->bound(Enlace2Client::class));
        $this->assertTrue($this->app->bound('enlace2'));
    }

    public function test_can_resolve_client_from_container()
    {
        $client = $this->app->make(Enlace2Client::class);

        $this->assertInstanceOf(Enlace2Client::class, $client);
    }

    public function test_can_resolve_client_via_alias()
    {
        $client = $this->app->make('enlace2');

        $this->assertInstanceOf(Enlace2Client::class, $client);
    }

    public function test_service_provider_is_registered()
    {
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(Enlace2ServiceProvider::class, $providers);
    }

    public function test_config_is_merged()
    {
        $config = $this->app->make('config');

        $this->assertEquals('test-api-key', $config->get('enlace2.api_key'));
        $this->assertEquals('https://enlace2.com/api/', $config->get('enlace2.base_url'));
    }
}