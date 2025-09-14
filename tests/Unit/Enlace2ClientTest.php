<?php

namespace Enlace2\LaravelUrlShortener\Tests\Unit;

use Enlace2\LaravelUrlShortener\Tests\TestCase;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Services\LinkService;
use Enlace2\LaravelUrlShortener\Services\QrService;
use Enlace2\LaravelUrlShortener\Services\CampaignService;
use Enlace2\LaravelUrlShortener\Services\ChannelService;

class Enlace2ClientTest extends TestCase
{
    public function test_client_can_be_instantiated()
    {
        $client = new Enlace2Client('test-key');

        $this->assertInstanceOf(Enlace2Client::class, $client);
    }

    public function test_client_returns_link_service()
    {
        $client = new Enlace2Client('test-key');
        $service = $client->links();

        $this->assertInstanceOf(LinkService::class, $service);
    }

    public function test_client_returns_qr_service()
    {
        $client = new Enlace2Client('test-key');
        $service = $client->qr();

        $this->assertInstanceOf(QrService::class, $service);
    }

    public function test_client_returns_campaign_service()
    {
        $client = new Enlace2Client('test-key');
        $service = $client->campaigns();

        $this->assertInstanceOf(CampaignService::class, $service);
    }

    public function test_client_returns_channel_service()
    {
        $client = new Enlace2Client('test-key');
        $service = $client->channels();

        $this->assertInstanceOf(ChannelService::class, $service);
    }
}