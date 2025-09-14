<?php

/**
 * Laravel Integration Example
 *
 * This file shows how to use the Enlace2 package in a Laravel application.
 * Place this code in your Laravel controllers or services.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;

class UrlShortenerController extends Controller
{
    // Method 1: Using Facade
    public function shortenUrlWithFacade(Request $request)
    {
        try {
            $result = Enlace2::links()->shorten($request->url, [
                'custom' => $request->custom,
                'password' => $request->password,
                'expiry' => $request->expiry
            ]);

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (RateLimitException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Rate limit exceeded. Please try again later.'
            ], 429);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => 'API Error: ' . $e->getMessage()
            ], 400);
        }
    }

    // Method 2: Using Dependency Injection
    public function shortenUrlWithDI(Request $request, Enlace2Client $enlace2)
    {
        try {
            $result = $enlace2->links()->shorten($request->url);

            return response()->json([
                'success' => true,
                'short_url' => $result['short'],
                'original_url' => $result['url'],
                'id' => $result['id']
            ]);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Create QR Code
    public function createQrCode(Request $request)
    {
        try {
            $result = Enlace2::qr()->create([
                'data' => $request->data,
                'name' => $request->name ?? 'QR Code',
                'size' => $request->size ?? 200
            ]);

            return response()->json([
                'success' => true,
                'qr_url' => $result['qr'],
                'id' => $result['id']
            ]);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Get all links with pagination
    public function getAllLinks()
    {
        try {
            $links = Enlace2::links()->all();

            return response()->json([
                'success' => true,
                'links' => $links['data'] ?? [],
                'total' => $links['total'] ?? 0
            ]);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Campaign management
    public function createCampaign(Request $request)
    {
        try {
            $campaign = Enlace2::campaigns()->create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'campaign' => $campaign
            ]);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // Assign link to campaign
    public function assignLinkToCampaign(Request $request)
    {
        try {
            $result = Enlace2::campaigns()->assignLink(
                $request->campaign_id,
                $request->link_id
            );

            return response()->json([
                'success' => true,
                'message' => 'Link assigned to campaign successfully'
            ]);

        } catch (ApiException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }
}

/**
 * Service Class Example
 */
class UrlShortenerService
{
    protected $enlace2;

    public function __construct(Enlace2Client $enlace2)
    {
        $this->enlace2 = $enlace2;
    }

    public function createShortUrl($url, $options = [])
    {
        return $this->enlace2->links()->shorten($url, $options);
    }

    public function getUrlStats($linkId)
    {
        return $this->enlace2->links()->get($linkId);
    }

    public function bulkCreateUrls(array $urls)
    {
        $results = [];

        foreach ($urls as $url) {
            try {
                $results[] = $this->enlace2->links()->shorten($url);
            } catch (ApiException $e) {
                $results[] = [
                    'error' => $e->getMessage(),
                    'url' => $url
                ];
            }
        }

        return $results;
    }
}

/**
 * Routes example (routes/api.php)
 */
/*
Route::prefix('url-shortener')->group(function () {
    Route::post('/shorten', [UrlShortenerController::class, 'shortenUrlWithFacade']);
    Route::post('/qr', [UrlShortenerController::class, 'createQrCode']);
    Route::get('/links', [UrlShortenerController::class, 'getAllLinks']);
    Route::post('/campaign', [UrlShortenerController::class, 'createCampaign']);
    Route::post('/campaign/assign', [UrlShortenerController::class, 'assignLinkToCampaign']);
});
*/