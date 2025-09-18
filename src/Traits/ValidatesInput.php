<?php

namespace Enlace2\LaravelUrlShortener\Traits;

use Enlace2\LaravelUrlShortener\Exceptions\ApiException;

trait ValidatesInput
{
    /**
     * Validate a URL
     */
    protected function validateUrl(string $url): void
    {
        $config = $this->getValidationConfig();

        if ($config['strict_urls']) {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new ApiException('Invalid URL format provided', 400);
            }

            $parsedUrl = parse_url($url);
            if (!in_array(strtolower($parsedUrl['scheme'] ?? ''), $config['allowed_protocols'])) {
                throw new ApiException('URL protocol not allowed. Allowed protocols: ' . implode(', ', $config['allowed_protocols']), 400);
            }
        }

        if (strlen($url) > $config['max_url_length']) {
            throw new ApiException("URL exceeds maximum length of {$config['max_url_length']} characters", 400);
        }
    }

    /**
     * Validate campaign data
     */
    protected function validateCampaignData(array $data): void
    {
        if (empty($data['name'])) {
            throw new ApiException('Campaign name is required', 400);
        }

        if (strlen($data['name']) > 255) {
            throw new ApiException('Campaign name must not exceed 255 characters', 400);
        }

        if (isset($data['description']) && strlen($data['description']) > 1000) {
            throw new ApiException('Campaign description must not exceed 1000 characters', 400);
        }
    }

    /**
     * Validate channel data
     */
    protected function validateChannelData(array $data): void
    {
        if (empty($data['name'])) {
            throw new ApiException('Channel name is required', 400);
        }

        if (strlen($data['name']) > 255) {
            throw new ApiException('Channel name must not exceed 255 characters', 400);
        }
    }

    /**
     * Validate QR code data
     */
    protected function validateQrData(array $data): void
    {
        if (isset($data['size'])) {
            $size = (int) $data['size'];
            if ($size < 50 || $size > 2000) {
                throw new ApiException('QR code size must be between 50 and 2000 pixels', 400);
            }
        }

        if (isset($data['format']) && !in_array(strtolower($data['format']), ['png', 'svg', 'jpg', 'jpeg'])) {
            throw new ApiException('Invalid QR code format. Allowed formats: PNG, SVG, JPG, JPEG', 400);
        }
    }

    /**
     * Get validation configuration
     */
    private function getValidationConfig(): array
    {
        if (function_exists('config')) {
            return config('enlace2.validation', [
                'strict_urls' => true,
                'max_url_length' => 2048,
                'allowed_protocols' => ['http', 'https'],
            ]);
        }

        return [
            'strict_urls' => true,
            'max_url_length' => 2048,
            'allowed_protocols' => ['http', 'https'],
        ];
    }
}