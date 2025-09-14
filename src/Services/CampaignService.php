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

    public function assignLink($campaignId, $linkId)
    {
        return $this->client->makeRequest('POST', "campaign/{$campaignId}/assign/{$linkId}");
    }
}