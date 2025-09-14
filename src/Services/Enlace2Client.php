<?php

namespace Enlace2\LaravelUrlShortener\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;
use Enlace2\LaravelUrlShortener\Services\LinkService;
use Enlace2\LaravelUrlShortener\Services\QrService;
use Enlace2\LaravelUrlShortener\Services\CampaignService;
use Enlace2\LaravelUrlShortener\Services\ChannelService;

class Enlace2Client
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct($apiKey, $baseUrl = 'https://enlace2.com/api/', $timeout = 30)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/') . '/';

        // Try to get config from Laravel if available, otherwise use default
        $timeoutValue = $timeout;
        if (function_exists('config') && function_exists('app')) {
            try {
                $timeoutValue = config('enlace2.timeout', $timeout);
            } catch (\Exception $e) {
                $timeoutValue = $timeout;
            }
        }

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $timeoutValue,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function makeRequest($method, $endpoint, $data = [])
    {
        try {
            $options = [];
            if (!empty($data)) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $endpoint, $options);
            $body = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() >= 400) {
                throw new ApiException(
                    $body['message'] ?? 'API Error',
                    $response->getStatusCode(),
                    $body
                );
            }

            return $body;

        } catch (GuzzleException $e) {
            if ($e->getCode() === 429) {
                throw new RateLimitException('Rate limit exceeded', 429);
            }

            throw new ApiException(
                'Request failed: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function links()
    {
        return new LinkService($this);
    }

    public function qr()
    {
        return new QrService($this);
    }

    public function campaigns()
    {
        return new CampaignService($this);
    }

    public function channels()
    {
        return new ChannelService($this);
    }
}