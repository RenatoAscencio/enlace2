<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;

echo "=== Enlace2 Laravel Package - Example Usage ===\n\n";

if (!isset($argv[1])) {
    echo "Usage: php examples/basic_usage.php YOUR_API_KEY\n";
    echo "Get your API key from: https://enlace2.com\n";
    exit(1);
}

$apiKey = $argv[1];
$client = new Enlace2Client($apiKey);

try {
    echo "1. Testing connection and getting all links...\n";
    $links = $client->links()->all();
    echo "✅ Connection successful!\n";
    echo "   Found " . (isset($links['data']) ? count($links['data']) : 0) . " links in your account\n\n";

    echo "2. Creating a shortened URL...\n";
    $result = $client->links()->shorten('https://google.com', [
        'custom' => 'google-test-' . time()
    ]);

    if (isset($result['short'])) {
        echo "✅ URL shortened successfully!\n";
        echo "   Original: https://google.com\n";
        echo "   Shortened: " . $result['short'] . "\n";
        $linkId = $result['id'] ?? null;
        echo "   Link ID: " . $linkId . "\n\n";

        if ($linkId) {
            echo "3. Getting link details...\n";
            $linkDetails = $client->links()->get($linkId);
            echo "✅ Link details retrieved!\n";
            echo "   Title: " . ($linkDetails['title'] ?? 'N/A') . "\n";
            echo "   Clicks: " . ($linkDetails['clicks'] ?? 0) . "\n";
            echo "   Status: " . ($linkDetails['status'] ?? 'N/A') . "\n\n";
        }
    }

    echo "4. Testing QR Code creation...\n";
    $qrResult = $client->qr()->create([
        'data' => 'https://enlace2.com',
        'name' => 'Test QR Code'
    ]);

    if (isset($qrResult['qr'])) {
        echo "✅ QR Code created successfully!\n";
        echo "   QR Code URL: " . $qrResult['qr'] . "\n\n";
    }

    echo "5. Testing Campaign creation...\n";
    $campaignResult = $client->campaigns()->create([
        'name' => 'Test Campaign ' . date('Y-m-d H:i:s'),
        'description' => 'Campaign created by Laravel package test'
    ]);

    if (isset($campaignResult['id'])) {
        echo "✅ Campaign created successfully!\n";
        echo "   Campaign ID: " . $campaignResult['id'] . "\n";
        echo "   Campaign Name: " . $campaignResult['name'] . "\n\n";
    }

    echo "🎉 All tests completed successfully!\n";
    echo "Your Enlace2 Laravel package is working perfectly.\n\n";

} catch (RateLimitException $e) {
    echo "❌ Rate limit exceeded: " . $e->getMessage() . "\n";
    echo "Please wait a minute before trying again.\n";
} catch (ApiException $e) {
    echo "❌ API Error: " . $e->getMessage() . "\n";
    echo "Error Code: " . $e->getCode() . "\n";
    if ($e->getResponse()) {
        echo "Response: " . json_encode($e->getResponse()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Unexpected Error: " . $e->getMessage() . "\n";
}