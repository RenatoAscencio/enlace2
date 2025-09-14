<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Services\QrService;

class QrServiceTest extends TestCase
{
    public function test_qr_service_can_be_instantiated()
    {
        $client = new Enlace2Client('test-key');
        $service = new QrService($client);

        $this->assertInstanceOf(QrService::class, $service);
    }

    public function test_can_create_qr_code()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'qr/add', ['data' => 'https://example.com', 'size' => 200])
            ->willReturn([
                'id' => 1,
                'qr' => 'https://enlace2.com/qr/abc123.png',
                'data' => 'https://example.com'
            ]);

        $service = new QrService($client);
        $result = $service->create(['data' => 'https://example.com', 'size' => 200]);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('https://enlace2.com/qr/abc123.png', $result['qr']);
    }

    public function test_can_get_all_qr_codes()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('GET', 'qr')
            ->willReturn([
                'data' => [
                    ['id' => 1, 'name' => 'QR 1'],
                    ['id' => 2, 'name' => 'QR 2']
                ]
            ]);

        $service = new QrService($client);
        $result = $service->all();

        $this->assertCount(2, $result['data']);
    }
}