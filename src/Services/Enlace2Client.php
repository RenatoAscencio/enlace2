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
use Enlace2\LaravelUrlShortener\Services\DomainService;
use Enlace2\LaravelUrlShortener\Services\PixelService;
use Enlace2\LaravelUrlShortener\Services\OverlayService;
use Enlace2\LaravelUrlShortener\Traits\LogsActivity;
use Enlace2\LaravelUrlShortener\Traits\CachesResponses;

class Enlace2Client
{
    use LogsActivity, CachesResponses;
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
        $this->logRequest($method, $endpoint, $data);

        try {
            $options = [];
            if (!empty($data)) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $endpoint, $options);
            $body = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            $this->logResponse($method, $endpoint, $body, $statusCode);

            if ($statusCode >= 400) {
                throw new ApiException(
                    $body['message'] ?? 'API Error',
                    $statusCode,
                    $body
                );
            }

            return $body;
        } catch (GuzzleException $e) {
            $this->logError($method, $endpoint, $e);

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

    public function domains()
    {
        return new DomainService($this);
    }

    public function pixels()
    {
        return new PixelService($this);
    }

    public function overlays()
    {
        return new OverlayService($this);
    }
}
