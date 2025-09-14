<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Services\LinkService;

class LinkServiceTest extends TestCase
{
    public function test_link_service_can_be_instantiated()
    {
        $client = new Enlace2Client('test-key');
        $service = new LinkService($client);

        $this->assertInstanceOf(LinkService::class, $service);
    }

    public function test_can_create_shortened_url()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'url/add', ['url' => 'https://example.com'])
            ->willReturn([
                'short' => 'https://enlace2.com/abc123',
                'url' => 'https://example.com'
            ]);

        $service = new LinkService($client);
        $result = $service->shorten('https://example.com');

        $this->assertEquals('https://enlace2.com/abc123', $result['short']);
        $this->assertEquals('https://example.com', $result['url']);
    }
}