<?php

namespace Enlace2\LaravelUrlShortener\Tests\Integration;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;

class RealApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!env('ENLACE2_API_KEY')) {
            $this->markTestSkipped('No API key provided for real API tests. Set ENLACE2_API_KEY environment variable to run these tests.');
        }
    }

    public function test_can_connect_to_api_with_invalid_key()
    {
        $client = new Enlace2Client('invalid-key');

        $this->expectException(ApiException::class);

        $client->links()->all();
    }

    public function test_can_shorten_url_with_real_api()
    {
        $this->markTestSkipped('Uncomment this test only when you want to test with a real API key');

        $client = new Enlace2Client(env('ENLACE2_API_KEY'));

        $result = $client->links()->shorten('https://google.com');

        $this->assertArrayHasKey('short', $result);
        $this->assertArrayHasKey('url', $result);
        $this->assertEquals('https://google.com', $result['url']);
    }

    public function test_rate_limiting_is_respected()
    {
        $this->markTestSkipped('This test makes multiple API calls - use with caution');

        $client = new Enlace2Client(env('ENLACE2_API_KEY'));

        for ($i = 0; $i < 35; $i++) {
            try {
                $client->links()->all();
            } catch (ApiException $e) {
                if ($e->getCode() === 429) {
                    $this->assertEquals(429, $e->getCode());
                    break;
                }
            }
        }
    }
}