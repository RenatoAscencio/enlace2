<?php

namespace Enlace2\LaravelUrlShortener\Services;

class OverlayService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'overlay');
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "overlay/{$id}");
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'overlay/add', $data);
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "overlay/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "overlay/{$id}/delete");
    }
}
