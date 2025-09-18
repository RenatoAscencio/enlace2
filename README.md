# Enlace2 Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Total Downloads](https://img.shields.io/packagist/dt/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Tests](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml/badge.svg)](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml)
[![PHP Version](https://img.shields.io/packagist/php-v/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Laravel](https://img.shields.io/badge/Laravel-9%20%7C%2010%20%7C%2011-red?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)

Un package completo de Laravel para integrar fácilmente el servicio de acortamiento de URLs de Enlace2 en tus aplicaciones Laravel. Incluye soporte para acortamiento de URLs, códigos QR, campañas, canales y todas las funcionalidades avanzadas de la API de Enlace2.

## Requisitos

- **PHP**: 8.1, 8.2, 8.3+
- **Laravel**: 9.x, 10.x, 11.x
- **Extensiones PHP**: cURL, JSON, mbstring

## Funcionalidades

- ✅ **Acortamiento de URLs** con opciones personalizadas
- ✅ **Códigos QR** dinámicos y personalizables
- ✅ **Campañas** para organizar tus enlaces
- ✅ **Canales** para segmentación avanzada
- ✅ **Geo-targeting** y **Device targeting**
- ✅ **Protección con contraseña** y **fechas de expiración**
- ✅ **Tracking detallado** de clicks y estadísticas
- ✅ **Manejo robusto de errores** y rate limiting
- ✅ **Facade de Laravel** para fácil uso
- ✅ **Configuración flexible**
- ✅ **Tests completos** (30+ tests)

## Instalación

Puedes instalar el package vía Composer:

```bash
composer require enlace2/laravel-url-shortener
```

El package se auto-registra automáticamente en Laravel 5.5+.

## Configuración

1. Publica el archivo de configuración:

```bash
php artisan vendor:publish --provider="Enlace2\LaravelUrlShortener\Enlace2ServiceProvider"
```

2. Agrega tu API key de Enlace2 en tu archivo `.env`:

```env
ENLACE2_API_KEY=tu_api_key_aqui
```

Puedes obtener tu API key registrándote en [Enlace2.com](https://enlace2.com) y accediendo a tu dashboard.

## Uso

### Usando la Facade

```php
use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Acortar una URL
$result = Enlace2::links()->shorten('https://example.com');
echo $result['short']; // https://enlace2.com/abc123

// Acortar con opciones adicionales
$result = Enlace2::links()->shorten('https://example.com', [
    'custom' => 'mi-enlace-personalizado',
    'password' => 'mi-password',
    'expiry' => '2024-12-31 23:59:59'
]);

// Obtener todas las URLs
$urls = Enlace2::links()->all();

// Obtener una URL específica
$url = Enlace2::links()->get($id);

// Actualizar una URL
$updated = Enlace2::links()->update($id, [
    'url' => 'https://nueva-url.com'
]);

// Eliminar una URL
Enlace2::links()->delete($id);
```

### Usando Inyección de Dependencias

```php
use Enlace2\LaravelUrlShortener\Services\Enlace2Client;

class MiControlador extends Controller
{
    public function acortarUrl(Enlace2Client $enlace2)
    {
        $resultado = $enlace2->links()->shorten('https://example.com');

        return response()->json($resultado);
    }
}
```

### Trabajando con QR Codes

```php
// Crear un código QR
$qr = Enlace2::qr()->create([
    'data' => 'https://example.com',
    'size' => 200
]);

// Obtener todos los códigos QR
$qrCodes = Enlace2::qr()->all();

// Actualizar un código QR
$updated = Enlace2::qr()->update($id, [
    'size' => 300
]);

// Eliminar un código QR
Enlace2::qr()->delete($id);
```

### Trabajando con Campañas

```php
// Crear una campaña
$campaign = Enlace2::campaigns()->create([
    'name' => 'Mi Campaña',
    'description' => 'Descripción de la campaña'
]);

// Obtener todas las campañas
$campaigns = Enlace2::campaigns()->all();

// Asignar un enlace a una campaña
Enlace2::campaigns()->assignLink($campaignId, $linkId);
```

### Trabajando con Canales

```php
// Crear un canal
$channel = Enlace2::channels()->create([
    'name' => 'Mi Canal',
    'description' => 'Descripción del canal'
]);

// Obtener todos los canales
$channels = Enlace2::channels()->all();

// Asignar un elemento a un canal
Enlace2::channels()->assign($channelId, 'url', $itemId);
```

## Manejo de Errores

El package incluye manejo de errores personalizado:

```php
use Enlace2\LaravelUrlShortener\Exceptions\ApiException;
use Enlace2\LaravelUrlShortener\Exceptions\RateLimitException;

try {
    $result = Enlace2::links()->shorten('https://example.com');
} catch (RateLimitException $e) {
    // Se alcanzó el límite de rate (30 requests por minuto)
    echo 'Rate limit alcanzado: ' . $e->getMessage();
} catch (ApiException $e) {
    // Error general de la API
    echo 'Error de API: ' . $e->getMessage();
}
```

## Configuración Avanzada

El archivo de configuración `config/enlace2.php` te permite personalizar:

```php
return [
    // Tu API key de Enlace2
    'api_key' => env('ENLACE2_API_KEY'),

    // URL base de la API (normalmente no necesitas cambiar esto)
    'base_url' => env('ENLACE2_BASE_URL', 'https://enlace2.com/api/'),

    // Timeout para las peticiones en segundos
    'timeout' => env('ENLACE2_TIMEOUT', 30),

    // Habilitar protección de rate limiting
    'rate_limiting' => env('ENLACE2_RATE_LIMITING', true),
];
```

## Funcionalidades Soportadas

- ✅ Acortamiento de URLs
- ✅ URLs personalizadas
- ✅ Protección con contraseña
- ✅ Fechas de expiración
- ✅ Códigos QR
- ✅ Campañas
- ✅ Canales
- ✅ Geo-targeting
- ✅ Device targeting
- ✅ Tracking de clicks
- ✅ Manejo de errores
- ✅ Rate limiting

## Testing

```bash
composer test
```

## Contribuir

Las contribuciones son bienvenidas. Por favor, asegúrate de que tus cambios incluyan tests apropiados.

## Licencia

Este package es software de código abierto licenciado bajo la [Licencia MIT](LICENSE.md).

## Soporte

- Documentación de la API: [https://enlace2.com/developers](https://enlace2.com/developers)
- Issues: Reporta problemas en GitHub
- Email: Contacta el soporte de Enlace2

## Testing

Ejecuta los tests con:

```bash
composer test
```

Para generar coverage:

```bash
composer test-coverage
```

## Changelog

### v1.0.1 (2025-01-XX)
- Añadido soporte completo para uso standalone (fuera de Laravel)
- Suite de tests comprensiva (30+ tests)
- Ejemplos de uso y documentación mejorada
- Correcciones de compatibilidad PHP 8.4
- Manejo robusto de errores mejorado

### v1.0.0 (2025-01-XX)
- Release inicial con soporte completo para la API de Enlace2