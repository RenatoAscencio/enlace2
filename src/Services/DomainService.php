<?php

namespace Enlace2\LaravelUrlShortener\Services;

class DomainService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'domains');
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "domain/{$id}");
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'domain/add', $data);
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "domain/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "domain/{$id}/delete");
    }
}
