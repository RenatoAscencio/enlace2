<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Services\CampaignService;

class CampaignServiceTest extends TestCase
{
    public function test_campaign_service_can_be_instantiated()
    {
        $client = new Enlace2Client('test-key');
        $service = new CampaignService($client);

        $this->assertInstanceOf(CampaignService::class, $service);
    }

    public function test_can_create_campaign()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'campaign/add', ['name' => 'Test Campaign', 'description' => 'Test Description'])
            ->willReturn([
                'id' => 1,
                'name' => 'Test Campaign',
                'description' => 'Test Description'
            ]);

        $service = new CampaignService($client);
        $result = $service->create(['name' => 'Test Campaign', 'description' => 'Test Description']);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('Test Campaign', $result['name']);
    }

    public function test_can_assign_link_to_campaign()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'campaign/1/assign/123')
            ->willReturn(['success' => true]);

        $service = new CampaignService($client);
        $result = $service->assignLink(1, 123);

        $this->assertTrue($result['success']);
    }
}