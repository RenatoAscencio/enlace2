<?php

namespace Enlace2\LaravelUrlShortener\Services;

class QrService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'qr');
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'qr/add', $data);
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "qr/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "qr/{$id}/delete");
    }
}