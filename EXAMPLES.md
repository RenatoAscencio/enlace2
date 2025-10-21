# Ejemplos Prácticos - Enlace2 Laravel Package

Esta colección de ejemplos te ayudará a implementar rápidamente las funcionalidades del SDK de Enlace2 en tu aplicación Laravel.

## 📋 Tabla de Contenidos

- [Configuración Inicial](#configuración-inicial)
- [Ejemplos Básicos](#ejemplos-básicos)
- [Ejemplos Avanzados](#ejemplos-avanzados)
- [Integración con Controladores](#integración-con-controladores)
- [Middleware Personalizado](#middleware-personalizado)
- [Jobs y Colas](#jobs-y-colas)
- [Testing](#testing)
- [Casos de Uso Reales](#casos-de-uso-reales)

## ⚙️ Configuración Inicial

### 1. Instalación y Configuración

```bash
# Instalar el package
composer require enlace2/laravel-url-shortener

# Publicar configuración
php artisan vendor:publish --provider="Enlace2\LaravelUrlShortener\Enlace2ServiceProvider"

# Agregar API key al .env
echo "ENLACE2_API_KEY=tu_api_key_aqui" >> .env
```

### 2. Configuración Personalizada

```php
// config/enlace2.php
return [
    'api_key' => env('ENLACE2_API_KEY'),
    'base_url' => env('ENLACE2_BASE_URL', 'https://enlace2.com/api/'),
    'timeout' => env('ENLACE2_TIMEOUT', 30),
    'rate_limiting' => env('ENLACE2_RATE_LIMITING', true),
    'cache' => [
        'enabled' => true,
        'ttl' => 3600,
        'store' => 'default',
        'prefix' => 'enlace2:',
    ],
    'logging' => [
        'enabled' => true,
        'channel' => 'default',
        'level' => 'info',
        'log_requests' => true,
        'log_responses' => false,
    ],
];
```

## 🚀 Ejemplos Básicos

### 1. Acortar URL Simple

```php
<?php

use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Acortar una URL básica
$result = Enlace2::links()->shorten('https://google.com');

echo "URL original: " . $result['data']['longurl'];
echo "URL acortada: " . $result['data']['shorturl'];
echo "Alias: " . $result['data']['alias'];
```

### 2. Acortar URL con Opciones

```php
<?php

use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Acortar con opciones personalizadas
$result = Enlace2::links()->shorten('https://mi-tienda.com/producto', [
    'custom' => 'producto-especial',
    'title' => 'Producto Especial',
    'description' => 'Descripción del producto',
    'password' => 'password123',
    'expiry' => '2024-12-31 23:59:59'
]);

echo "Enlace protegido: " . $result['data']['shorturl'];
```

### 3. Crear Código QR

```php
<?php

use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Crear código QR
$qr = Enlace2::qr()->create([
    'data' => 'https://mi-sitio.com',
    'size' => 300,
    'name' => 'QR Mi Sitio',
    'format' => 'png'
]);

echo "Código QR creado: " . $qr['data']['link'];
echo "Escaneos: " . $qr['data']['scans'];
```

### 4. Gestionar Campañas

```php
<?php

use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Crear campaña
$campaign = Enlace2::campaigns()->create([
    'name' => 'Black Friday 2024',
    'description' => 'Campaña de descuentos'
]);

echo "Campaña creada: " . $campaign['data']['name'];

// Listar campañas
$campaigns = Enlace2::campaigns()->all();
echo "Total de campañas: " . $campaigns['data']['result'];
```

## 🔥 Ejemplos Avanzados

### 1. Sistema Completo de Marketing

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Support\Facades\Log;

class MarketingService
{
    public function createMarketingCampaign($data)
    {
        try {
            // 1. Crear campaña
            $campaign = Enlace2::campaigns()->create([
                'name' => $data['campaign_name'],
                'description' => $data['description']
            ]);

            // 2. Crear canal
            $channel = Enlace2::channels()->create([
                'name' => $data['channel_name'],
                'description' => $data['channel_description'],
                'color' => $data['color'] ?? '#FF6B6B'
            ]);

            // 3. Crear enlaces para cada URL
            $links = [];
            foreach ($data['urls'] as $urlData) {
                $link = Enlace2::links()->shorten($urlData['url'], [
                    'custom' => $urlData['alias'],
                    'title' => $urlData['title'],
                    'description' => $urlData['description'],
                    'password' => $urlData['password'] ?? null,
                    'expiry' => $urlData['expiry'] ?? null
                ]);

                // Asignar a campaña y canal
                Enlace2::campaigns()->assignLink($campaign['data']['id'], $link['data']['id']);
                Enlace2::channels()->assign($channel['data']['id'], 'url', $link['data']['id']);

                $links[] = $link['data'];
            }

            // 4. Crear códigos QR si se solicitan
            if ($data['create_qr'] ?? false) {
                foreach ($links as $link) {
                    Enlace2::qr()->create([
                        'data' => $link['shorturl'],
                        'size' => $data['qr_size'] ?? 200,
                        'name' => "QR - {$link['title']}"
                    ]);
                }
            }

            return [
                'success' => true,
                'campaign' => $campaign['data'],
                'channel' => $channel['data'],
                'links' => $links
            ];

        } catch (\Exception $e) {
            Log::error('Error creating marketing campaign: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
```

### 2. Sistema de Analytics Avanzado

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Support\Facades\Cache;

class AnalyticsService
{
    public function getLinkAnalytics($linkId)
    {
        $cacheKey = "link_analytics_{$linkId}";
        
        return Cache::remember($cacheKey, 300, function () use ($linkId) {
            $link = Enlace2::links()->get($linkId);
            
            return [
                'total_clicks' => $link['data']['clicks'],
                'unique_clicks' => $link['data']['uniqueclicks'],
                'click_rate' => $this->calculateClickRate($link['data']),
                'last_click' => $link['data']['date'],
                'campaign' => $link['data']['campaign'],
                'channels' => $link['data']['channel']
            ];
        });
    }

    public function getCampaignPerformance($campaignId)
    {
        $campaign = Enlace2::campaigns()->get($campaignId);
        $links = Enlace2::links()->all();
        
        $campaignLinks = collect($links['data']['urls'])
            ->filter(function ($link) use ($campaignId) {
                return $link['campaign'] == $campaignId;
            });

        $totalClicks = $campaignLinks->sum('clicks');
        $totalUniqueClicks = $campaignLinks->sum('uniqueclicks');

        return [
            'campaign' => $campaign['data'],
            'total_links' => $campaignLinks->count(),
            'total_clicks' => $totalClicks,
            'total_unique_clicks' => $totalUniqueClicks,
            'average_clicks_per_link' => $campaignLinks->count() > 0 ? $totalClicks / $campaignLinks->count() : 0,
            'top_performing_links' => $campaignLinks->sortByDesc('clicks')->take(5)->values()
        ];
    }

    private function calculateClickRate($linkData)
    {
        $clicks = (int) $linkData['clicks'];
        $uniqueClicks = (int) $linkData['uniqueclicks'];
        
        return $uniqueClicks > 0 ? round(($clicks / $uniqueClicks) * 100, 2) : 0;
    }
}
```

### 3. Sistema de Dominios Personalizados

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Support\Facades\Validator;

class DomainService
{
    public function setupBrandedDomain($domainData)
    {
        $validator = Validator::make($domainData, [
            'domain' => 'required|url',
            'redirect_root' => 'required|url',
            'redirect_404' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        try {
            $domain = Enlace2::domains()->create([
                'domain' => $domainData['domain'],
                'redirect_root' => $domainData['redirect_root'],
                'redirect_404' => $domainData['redirect_404'] ?? $domainData['redirect_root']
            ]);

            return ['success' => true, 'domain' => $domain['data']];

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function createBrandedLink($url, $customAlias, $domainId)
    {
        $domain = Enlace2::domains()->get($domainId);
        
        return Enlace2::links()->shorten($url, [
            'custom' => $customAlias,
            'domain' => $domain['data']['domain']
        ]);
    }
}
```

## 🎮 Integración con Controladores

### 1. Controlador de Enlaces

```php
<?php

namespace App\Http\Controllers;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $links = Enlace2::links()->all();
        
        return response()->json([
            'success' => true,
            'data' => $links['data']
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'url' => 'required|url',
            'custom' => 'nullable|string|max:50',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:4',
            'expiry' => 'nullable|date|after:now'
        ]);

        try {
            $result = Enlace2::links()->shorten($request->url, $request->only([
                'custom', 'title', 'description', 'password', 'expiry'
            ]));

            return response()->json([
                'success' => true,
                'data' => $result['data']
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $link = Enlace2::links()->get($id);
            
            return response()->json([
                'success' => true,
                'data' => $link['data']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Link not found'
            ], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            Enlace2::links()->delete($id);
            
            return response()->json([
                'success' => true,
                'message' => 'Link deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
```

### 2. Controlador de Campañas

```php
<?php

namespace App\Http\Controllers;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function index(): JsonResponse
    {
        $campaigns = Enlace2::campaigns()->all();
        
        return response()->json([
            'success' => true,
            'data' => $campaigns['data']
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        try {
            $campaign = Enlace2::campaigns()->create($request->all());

            return response()->json([
                'success' => true,
                'data' => $campaign['data']
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function assignLink(Request $request, $campaignId): JsonResponse
    {
        $request->validate([
            'link_id' => 'required|integer'
        ]);

        try {
            $result = Enlace2::campaigns()->assignLink($campaignId, $request->link_id);

            return response()->json([
                'success' => true,
                'message' => 'Link assigned to campaign successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
```

## 🛡️ Middleware Personalizado

### 1. Middleware de Rate Limiting

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;

class Enlace2RateLimitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intentar hacer una petición de prueba
            Enlace2::links()->all();
            
            return $next($request);

        } catch (RateLimitException $e) {
            return response()->json([
                'error' => 'Rate limit exceeded',
                'message' => 'Too many requests. Please try again later.',
                'retry_after' => 60
            ], 429);
        }
    }
}
```

### 2. Middleware de Validación de API Key

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateEnlace2ApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = config('enlace2.api_key');
        
        if (empty($apiKey)) {
            return response()->json([
                'error' => 'API key not configured',
                'message' => 'Please configure your Enlace2 API key'
            ], 500);
        }

        return $next($request);
    }
}
```

## 🔄 Jobs y Colas

### 1. Job para Crear Enlaces Masivos

```php
<?php

namespace App\Jobs;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateBulkLinks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urls;
    protected $campaignId;
    protected $channelId;

    public function __construct(array $urls, $campaignId = null, $channelId = null)
    {
        $this->urls = $urls;
        $this->campaignId = $campaignId;
        $this->channelId = $channelId;
    }

    public function handle()
    {
        $createdLinks = [];

        foreach ($this->urls as $urlData) {
            try {
                $link = Enlace2::links()->shorten($urlData['url'], [
                    'custom' => $urlData['alias'] ?? null,
                    'title' => $urlData['title'] ?? null,
                    'description' => $urlData['description'] ?? null
                ]);

                // Asignar a campaña si se especifica
                if ($this->campaignId) {
                    Enlace2::campaigns()->assignLink($this->campaignId, $link['data']['id']);
                }

                // Asignar a canal si se especifica
                if ($this->channelId) {
                    Enlace2::channels()->assign($this->channelId, 'url', $link['data']['id']);
                }

                $createdLinks[] = $link['data'];

                Log::info("Link created: {$link['data']['shorturl']}");

            } catch (\Exception $e) {
                Log::error("Failed to create link for {$urlData['url']}: " . $e->getMessage());
            }
        }

        return $createdLinks;
    }
}
```

### 2. Job para Generar Códigos QR

```php
<?php

namespace App\Jobs;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateQRCodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $links;
    protected $qrOptions;

    public function __construct(array $links, array $qrOptions = [])
    {
        $this->links = $links;
        $this->qrOptions = array_merge([
            'size' => 200,
            'format' => 'png'
        ], $qrOptions);
    }

    public function handle()
    {
        $createdQRs = [];

        foreach ($this->links as $link) {
            try {
                $qr = Enlace2::qr()->create([
                    'data' => $link['shorturl'],
                    'size' => $this->qrOptions['size'],
                    'name' => "QR - {$link['title']}",
                    'format' => $this->qrOptions['format']
                ]);

                $createdQRs[] = $qr['data'];

            } catch (\Exception $e) {
                Log::error("Failed to create QR for {$link['shorturl']}: " . $e->getMessage());
            }
        }

        return $createdQRs;
    }
}
```

## 🧪 Testing

### 1. Test de Servicio de Enlaces

```php
<?php

namespace Tests\Unit;

use Tests\TestCase;
use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;

class LinkServiceTest extends TestCase
{
    public function test_can_shorten_url()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'url/add', ['url' => 'https://example.com'])
            ->willReturn([
                'error' => 0,
                'data' => [
                    'id' => 1,
                    'shorturl' => 'https://enlace2.com/abc123',
                    'longurl' => 'https://example.com'
                ]
            ]);

        $service = new \Enlace2\LaravelUrlShortener\Services\LinkService($client);
        $result = $service->shorten('https://example.com');

        $this->assertEquals('https://enlace2.com/abc123', $result['data']['shorturl']);
    }

    public function test_can_shorten_url_with_options()
    {
        $client = $this->createMock(Enlace2Client::class);
        $client->method('makeRequest')
            ->with('POST', 'url/add', [
                'url' => 'https://example.com',
                'custom' => 'mi-enlace',
                'title' => 'Mi Enlace'
            ])
            ->willReturn([
                'error' => 0,
                'data' => [
                    'id' => 1,
                    'shorturl' => 'https://enlace2.com/mi-enlace',
                    'longurl' => 'https://example.com',
                    'title' => 'Mi Enlace'
                ]
            ]);

        $service = new \Enlace2\LaravelUrlShortener\Services\LinkService($client);
        $result = $service->shorten('https://example.com', [
            'custom' => 'mi-enlace',
            'title' => 'Mi Enlace'
        ]);

        $this->assertEquals('https://enlace2.com/mi-enlace', $result['data']['shorturl']);
        $this->assertEquals('Mi Enlace', $result['data']['title']);
    }
}
```

### 2. Test de Integración

```php
<?php

namespace Tests\Integration;

use Tests\TestCase;
use Enlace2\LaravelUrlShortener\Facades\Enlace2;

class Enlace2IntegrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        if (!env('ENLACE2_API_KEY')) {
            $this->markTestSkipped('No API key provided for integration tests');
        }
    }

    public function test_can_shorten_url_with_real_api()
    {
        $result = Enlace2::links()->shorten('https://google.com');

        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('shorturl', $result['data']);
        $this->assertArrayHasKey('longurl', $result['data']);
        $this->assertEquals('https://google.com', $result['data']['longurl']);
    }

    public function test_can_create_campaign()
    {
        $campaign = Enlace2::campaigns()->create([
            'name' => 'Test Campaign',
            'description' => 'Test Description'
        ]);

        $this->assertArrayHasKey('data', $campaign);
        $this->assertArrayHasKey('id', $campaign['data']);
        $this->assertEquals('Test Campaign', $campaign['data']['name']);
    }
}
```

## 🎯 Casos de Uso Reales

### 1. E-commerce: Sistema de Enlaces de Productos

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use App\Models\Product;

class ProductLinkService
{
    public function createProductLink(Product $product, $channel = 'web')
    {
        $campaign = $this->getOrCreateCampaign('Productos E-commerce');
        $channelObj = $this->getOrCreateChannel($channel);

        $link = Enlace2::links()->shorten($product->url, [
            'custom' => "producto-{$product->id}-{$channel}",
            'title' => $product->name,
            'description' => "Enlace del producto: {$product->name}"
        ]);

        // Asignar a campaña y canal
        Enlace2::campaigns()->assignLink($campaign['data']['id'], $link['data']['id']);
        Enlace2::channels()->assign($channelObj['data']['id'], 'url', $link['data']['id']);

        return $link['data'];
    }

    private function getOrCreateCampaign($name)
    {
        $campaigns = Enlace2::campaigns()->all();
        $existing = collect($campaigns['data']['campaigns'])
            ->firstWhere('name', $name);

        if ($existing) {
            return ['data' => $existing];
        }

        return Enlace2::campaigns()->create(['name' => $name]);
    }

    private function getOrCreateChannel($name)
    {
        $channels = Enlace2::channels()->all();
        $existing = collect($channels['data']['channels'])
            ->firstWhere('name', $name);

        if ($existing) {
            return ['data' => $existing];
        }

        return Enlace2::channels()->create(['name' => $name]);
    }
}
```

### 2. Marketing: Sistema de Campañas por Email

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use Illuminate\Support\Facades\Mail;

class EmailMarketingService
{
    public function createEmailCampaign($emailData)
    {
        // Crear campaña
        $campaign = Enlace2::campaigns()->create([
            'name' => $emailData['campaign_name'],
            'description' => "Campaña de email: {$emailData['subject']}"
        ]);

        // Crear canal para email
        $channel = Enlace2::channels()->create([
            'name' => 'Email Marketing',
            'description' => 'Enlaces para campañas de email',
            'color' => '#3498db'
        ]);

        $links = [];
        foreach ($emailData['links'] as $linkData) {
            $link = Enlace2::links()->shorten($linkData['url'], [
                'custom' => "email-{$campaign['data']['id']}-{$linkData['alias']}",
                'title' => $linkData['title'],
                'description' => "Enlace de email: {$linkData['title']}"
            ]);

            // Asignar a campaña y canal
            Enlace2::campaigns()->assignLink($campaign['data']['id'], $link['data']['id']);
            Enlace2::channels()->assign($channel['data']['id'], 'url', $link['data']['id']);

            $links[] = $link['data'];
        }

        // Crear píxel de seguimiento si se especifica
        if ($emailData['pixel_id'] ?? false) {
            $pixel = Enlace2::pixels()->get($emailData['pixel_id']);
            // Aquí podrías integrar el píxel en el email
        }

        return [
            'campaign' => $campaign['data'],
            'channel' => $channel['data'],
            'links' => $links
        ];
    }
}
```

### 3. Eventos: Sistema de Tickets con QR

```php
<?php

namespace App\Services;

use Enlace2\LaravelUrlShortener\Facades\Enlace2;
use App\Models\Event;
use App\Models\Ticket;

class EventTicketService
{
    public function createEventTickets(Event $event, $ticketCount)
    {
        // Crear campaña para el evento
        $campaign = Enlace2::campaigns()->create([
            'name' => "Evento: {$event->name}",
            'description' => "Tickets para {$event->name} - {$event->date}"
        ]);

        // Crear canal para tickets
        $channel = Enlace2::channels()->create([
            'name' => 'Tickets QR',
            'description' => 'Códigos QR para tickets de eventos',
            'color' => '#e74c3c'
        ]);

        $tickets = [];
        for ($i = 1; $i <= $ticketCount; $i++) {
            // Crear enlace para el ticket
            $link = Enlace2::links()->shorten(route('ticket.show', ['event' => $event->id, 'ticket' => $i]), [
                'custom' => "ticket-{$event->id}-{$i}",
                'title' => "Ticket #{$i} - {$event->name}",
                'description' => "Ticket para {$event->name} - {$event->date}"
            ]);

            // Crear código QR para el ticket
            $qr = Enlace2::qr()->create([
                'data' => $link['data']['shorturl'],
                'size' => 300,
                'name' => "QR Ticket #{$i} - {$event->name}",
                'format' => 'png'
            ]);

            // Asignar a campaña y canal
            Enlace2::campaigns()->assignLink($campaign['data']['id'], $link['data']['id']);
            Enlace2::channels()->assign($channel['data']['id'], 'url', $link['data']['id']);

            $tickets[] = [
                'ticket_number' => $i,
                'link' => $link['data'],
                'qr' => $qr['data']
            ];
        }

        return [
            'campaign' => $campaign['data'],
            'channel' => $channel['data'],
            'tickets' => $tickets
        ];
    }
}
```

## 📚 Recursos Adicionales

- [Documentación Completa](README.md)
- [Referencia de Endpoints](API_ENDPOINTS.md)
- [Documentación Oficial de Enlace2](https://enlace2.com/developers)
- [GitHub Repository](https://github.com/RenatoAscencio/enlace2)

---

**Última actualización**: Enero 2025  
**Versión del SDK**: 1.2.0
