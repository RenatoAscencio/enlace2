<?php

namespace Enlace2\LaravelUrlShortener\Services;

class LinkService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'urls');
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "url/{$id}");
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'url/add', $data);
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "url/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "url/{$id}/delete");
    }

    public function shorten($url, $options = [])
    {
        $data = array_merge(['url' => $url], $options);
        return $this->create($data);
    }
}