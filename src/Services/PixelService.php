<?php

namespace Enlace2\LaravelUrlShortener\Services;

class PixelService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'pixels');
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "pixel/{$id}");
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'pixel/add', $data);
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "pixel/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "pixel/{$id}/delete");
    }
}
