<?php

namespace Enlace2\LaravelUrlShortener\Traits;

use Illuminate\Support\Facades\Cache;

trait CachesResponses
{
    /**
     * Get cached response or execute callback
     */
    protected function getCachedResponse(string $cacheKey, callable $callback, ?int $ttl = null)
    {
        $config = $this->getCacheConfig();

        if (!$config['enabled']) {
            return $callback();
        }

        $fullKey = $config['prefix'] . $cacheKey;
        $ttl = $ttl ?? $config['ttl'];

        if ($this->hasCache()) {
            return Cache::store($config['store'])->remember($fullKey, $ttl, $callback);
        }

        return $callback();
    }

    /**
     * Clear cached response
     */
    protected function clearCachedResponse(string $cacheKey): void
    {
        $config = $this->getCacheConfig();

        if (!$config['enabled'] || !$this->hasCache()) {
            return;
        }

        $fullKey = $config['prefix'] . $cacheKey;
        Cache::store($config['store'])->forget($fullKey);
    }

    /**
     * Clear all cached responses for this service
     */
    protected function clearAllCachedResponses(string $pattern = '*'): void
    {
        $config = $this->getCacheConfig();

        if (!$config['enabled'] || !$this->hasCache()) {
            return;
        }

        $fullPattern = $config['prefix'] . $pattern;

        // Note: This implementation depends on the cache driver
        // For Redis, you could use Cache::store($config['store'])->flush()
        // For file cache, this is a simplified implementation
        if (method_exists(Cache::store($config['store']), 'flush')) {
            Cache::store($config['store'])->flush();
        }
    }

    /**
     * Generate cache key for API requests
     */
    protected function generateCacheKey(string $method, string $endpoint, array $data = []): string
    {
        $keyData = [
            'method' => $method,
            'endpoint' => $endpoint,
            'data' => $data,
        ];

        return 'api:' . md5(serialize($keyData));
    }

    /**
     * Check if caching is available
     */
    private function hasCache(): bool
    {
        return class_exists(Cache::class) && function_exists('cache');
    }

    /**
     * Get cache configuration
     */
    private function getCacheConfig(): array
    {
        if (function_exists('config')) {
            return config('enlace2.cache', [
                'enabled' => true,
                'ttl' => 3600,
                'store' => 'default',
                'prefix' => 'enlace2:',
            ]);
        }

        return [
            'enabled' => false,
            'ttl' => 3600,
            'store' => 'default',
            'prefix' => 'enlace2:',
        ];
    }
}