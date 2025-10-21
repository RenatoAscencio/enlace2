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

    public function get($id)
    {
        return $this->client->makeRequest('GET', "channel/{$id}");
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "channel/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "channel/{$id}/delete");
    }

    public function assign($channelId, $type, $itemId)
    {
        return $this->client->makeRequest('POST', "channel/{$channelId}/assign", [
            'type' => $type,
            'item_id' => $itemId
        ]);
    }
}
