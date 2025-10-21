<?php

namespace Enlace2\LaravelUrlShortener\Services;

class CampaignService
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->makeRequest('GET', 'campaigns');
    }

    public function create($data)
    {
        return $this->client->makeRequest('POST', 'campaign/add', $data);
    }

    public function get($id)
    {
        return $this->client->makeRequest('GET', "campaign/{$id}");
    }

    public function update($id, $data)
    {
        return $this->client->makeRequest('PUT', "campaign/{$id}/update", $data);
    }

    public function delete($id)
    {
        return $this->client->makeRequest('DELETE', "campaign/{$id}/delete");
    }

    public function assignLink($campaignId, $linkId)
    {
        return $this->client->makeRequest('POST', "campaign/{$campaignId}/assign", ['link_id' => $linkId]);
    }
}
