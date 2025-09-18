<?php

namespace Enlace2\LaravelUrlShortener\Services;

use Enlace2\LaravelUrlShortener\Traits\ValidatesInput;
use Enlace2\LaravelUrlShortener\Traits\CachesResponses;

class LinkService
{
    use ValidatesInput, CachesResponses;
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        $cacheKey = $this->generateCacheKey('GET', 'urls');

        return $this->getCachedResponse($cacheKey, function () {
            return $this->client->makeRequest('GET', 'urls');
        });
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "url/{$id}");
    }

    public function create($data)
    {
        if (isset($data['url'])) {
            $this->validateUrl($data['url']);
        }

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
        $this->validateUrl($url);
        $data = array_merge(['url' => $url], $options);
        return $this->create($data);
    }
}