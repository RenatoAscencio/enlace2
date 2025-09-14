<?php

namespace Enlace2\LaravelUrlShortener\Services;

class ChannelService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'channels');
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'channel/add', $data);
    }

    public function assign($channelId, $type, $itemId)
    {
        return $this->client->makeRequest('POST', "channel/{$channelId}/assign/{$type}/{$itemId}");
    }
}