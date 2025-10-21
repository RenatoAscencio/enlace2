<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Services\ChannelService;

class ChannelServiceTest extends TestCase
{
    public function test_channel_service_can_be_instantiated()
    {
        $client = new Enlace2Client('test-key');
        $service = new ChannelService($client);

        $this->assertInstanceOf(ChannelService::class, $service);
    }

    public function test_can_create_channel()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'channel/add', ['name' => 'Test Channel'])
            ->willReturn([
                'id' => 1,
                'name' => 'Test Channel'
            ]);

        $service = new ChannelService($client);
        $result = $service->create(['name' => 'Test Channel']);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Test Channel', $result['name']);
    }

    public function test_can_assign_item_to_channel()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'channel/1/assign', ['type' => 'url', 'item_id' => 123])
            ->willReturn(['success' => true]);

        $service = new ChannelService($client);
        $result = $service->assign(1, 'url', 123);

        $this->assertTrue($result['success']);
    }
}