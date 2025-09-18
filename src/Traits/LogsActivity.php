<?php

namespace Enlace2\LaravelUrlShortener\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    /**
     * Log API request
     */
    protected function logRequest(string $method, string $endpoint, array $data = []): void
    {
        $config = $this->getLoggingConfig();

        if (!$config['enabled'] || !$config['log_requests']) {
            return;
        }

        $context = [
            'method' => $method,
            'endpoint' => $endpoint,
            'data' => $this->sanitizeLogData($data),
            'timestamp' => now()->toISOString(),
        ];

        $this->writeLog($config['level'], "Enlace2 API Request: {$method} {$endpoint}", $context);
    }

    /**
     * Log API response
     */
    protected function logResponse(string $method, string $endpoint, $response, int $statusCode): void
    {
        $config = $this->getLoggingConfig();

        if (!$config['enabled'] || !$config['log_responses']) {
            return;
        }

        $context = [
            'method' => $method,
            'endpoint' => $endpoint,
            'status_code' => $statusCode,
            'response' => $this->sanitizeLogData($response),
            'timestamp' => now()->toISOString(),
        ];

        $level = $statusCode >= 400 ? 'error' : $config['level'];
        $this->writeLog($level, "Enlace2 API Response: {$method} {$endpoint} ({$statusCode})", $context);
    }

    /**
     * Log API error
     */
    protected function logError(string $method, string $endpoint, \Exception $exception): void
    {
        $config = $this->getLoggingConfig();

        if (!$config['enabled']) {
            return;
        }

        $context = [
            'method' => $method,
            'endpoint' => $endpoint,
            'error' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'timestamp' => now()->toISOString(),
        ];

        $this->writeLog('error', "Enlace2 API Error: {$method} {$endpoint}", $context);
    }

    /**
     * Write log entry
     */
    private function writeLog(string $level, string $message, array $context = []): void
    {
        $config = $this->getLoggingConfig();

        if (function_exists('logger') && $config['channel'] === 'default') {
            logger()->$level($message, $context);
        } elseif (class_exists(Log::class)) {
            Log::channel($config['channel'])->$level($message, $context);
        }
    }

    /**
     * Sanitize sensitive data from logs
     */
    private function sanitizeLogData($data): array
    {
        if (!is_array($data)) {
            return ['data' => 'non-array-data'];
        }

        $sensitiveKeys = ['api_key', 'password', 'token', 'secret'];

        foreach ($sensitiveKeys as $key) {
            if (isset($data[$key])) {
                $data[$key] = '***REDACTED***';
            }
        }

        return $data;
    }

    /**
     * Get logging configuration
     */
    private function getLoggingConfig(): array
    {
        if (function_exists('config')) {
            return config('enlace2.logging', [
                'enabled' => false,
                'channel' => 'default',
                'level' => 'info',
                'log_requests' => true,
                'log_responses' => false,
            ]);
        }

        return [
            'enabled' => false,
            'channel' => 'default',
            'level' => 'info',
            'log_requests' => true,
            'log_responses' => false,
        ];
    }
}