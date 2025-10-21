# Enlace2 Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Total Downloads](https://img.shields.io/packagist/dt/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Tests](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml/badge.svg)](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml)
[![PHP Version](https://img.shields.io/packagist/php-v/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Laravel](https://img.shields.io/badge/Laravel-9%20%7C%2010%20%7C%2011%20%7C%2012-red?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)

Un package completo de Laravel para integrar fácilmente el servicio de acortamiento de URLs de Enlace2 en tus aplicaciones Laravel. Incluye soporte completo para todos los endpoints de la API de Enlace2: acortamiento de URLs, códigos QR, campañas, canales, dominios de marca, píxeles de seguimiento y superposiciones CTA.

## 🚀 Características Principales

- ✅ **100% Cobertura de API**: Todos los endpoints de Enlace2 implementados
- ✅ **7 Servicios Completos**: Links, QR, Campaigns, Channels, Domains, Pixels, Overlays
- ✅ **Acortamiento de URLs** con opciones personalizadas
- ✅ **Códigos QR** dinámicos y personalizables
- ✅ **Campañas** para organizar tus enlaces
- ✅ **Canales** para segmentación avanzada
- ✅ **Dominios de Marca** para URLs personalizadas
- ✅ **Píxeles de Seguimiento** para analytics
- ✅ **Superposiciones CTA** para conversiones
- ✅ **Geo-targeting** y **Device targeting**
- ✅ **Protección con contraseña** y **fechas de expiración**
- ✅ **Tracking detallado** de clicks y estadísticas
- ✅ **Manejo robusto de errores** y rate limiting
- ✅ **Facade de Laravel** para fácil uso
- ✅ **Configuración flexible**
- ✅ **Tests completos** (30+ tests)

## 📋 Requisitos

- **PHP**: 8.1, 8.2, 8.3+
- **Laravel**: 9.x, 10.x, 11.x, 12.x
- **Extensiones PHP**: cURL, JSON, mbstring

## 📦 Instalación

Puedes instalar el package vía Composer:

```bash
composer require enlace2/laravel-url-shortener
```

El package se auto-registra automáticamente en Laravel 5.5+.

## ⚙️ Configuración

1. Publica el archivo de configuración:

```bash
php artisan vendor:publish --provider="Enlace2\LaravelUrlShortener\Enlace2ServiceProvider"
```

2. Agrega tu API key de Enlace2 en tu archivo `.env`:

```env
ENLACE2_API_KEY=tu_api_key_aqui
```

Puedes obtener tu API key registrándote en [Enlace2.com](https://enlace2.com) y accediendo a tu dashboard.

## 🎯 Uso Básico

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

## 📚 Documentación Completa de Servicios

### 🔗 Servicio de Enlaces (Links)

El servicio de enlaces te permite crear, gestionar y rastrear URLs acortadas.

#### Métodos Disponibles

```php
// Obtener todos los enlaces
$links = Enlace2::links()->all();

// Obtener un enlace específico
$link = Enlace2::links()->get($id);

// Crear/acortar un enlace
$result = Enlace2::links()->shorten('https://example.com', [
    'custom' => 'mi-enlace',           // Alias personalizado
    'password' => 'password123',       // Protección con contraseña
    'expiry' => '2024-12-31 23:59:59', // Fecha de expiración
    'title' => 'Mi Enlace',            // Título del enlace
    'description' => 'Descripción',     // Descripción
    'domain' => 'https://mi-dominio.com' // Dominio personalizado
]);

// Actualizar un enlace
$updated = Enlace2::links()->update($id, [
    'url' => 'https://nueva-url.com',
    'title' => 'Nuevo título'
]);

// Eliminar un enlace
Enlace2::links()->delete($id);
```

#### Endpoints Utilizados

- `GET /api/urls` - Listar enlaces
- `GET /api/link/{id}` - Obtener enlace específico
- `POST /api/url/add` - Crear/acortar enlace
- `PUT /api/link/{id}/update` - Actualizar enlace
- `DELETE /api/link/{id}/delete` - Eliminar enlace

### 📱 Servicio de Códigos QR

Crea y gestiona códigos QR dinámicos para tus enlaces.

#### Métodos Disponibles

```php
// Obtener todos los códigos QR
$qrCodes = Enlace2::qr()->all();

// Obtener un código QR específico
$qr = Enlace2::qr()->get($id);

// Crear un código QR
$qr = Enlace2::qr()->create([
    'data' => 'https://example.com',    // URL o texto
    'size' => 200,                      // Tamaño en píxeles
    'name' => 'Mi QR Code',             // Nombre del QR
    'format' => 'png'                   // Formato (png, svg, jpg)
]);

// Actualizar un código QR
$updated = Enlace2::qr()->update($id, [
    'size' => 300,
    'name' => 'QR Actualizado'
]);

// Eliminar un código QR
Enlace2::qr()->delete($id);
```

#### Endpoints Utilizados

- `GET /api/qr` - Listar códigos QR
- `GET /api/qr/{id}` - Obtener código QR específico
- `POST /api/qr/add` - Crear código QR
- `PUT /api/qr/{id}/update` - Actualizar código QR
- `DELETE /api/qr/{id}/delete` - Eliminar código QR

### 🎯 Servicio de Campañas

Organiza tus enlaces en campañas para mejor gestión y análisis.

#### Métodos Disponibles

```php
// Obtener todas las campañas
$campaigns = Enlace2::campaigns()->all();

// Obtener una campaña específica
$campaign = Enlace2::campaigns()->get($id);

// Crear una campaña
$campaign = Enlace2::campaigns()->create([
    'name' => 'Mi Campaña',
    'description' => 'Descripción de la campaña'
]);

// Actualizar una campaña
$updated = Enlace2::campaigns()->update($id, [
    'name' => 'Campaña Actualizada',
    'description' => 'Nueva descripción'
]);

// Eliminar una campaña
Enlace2::campaigns()->delete($id);

// Asignar un enlace a una campaña
Enlace2::campaigns()->assignLink($campaignId, $linkId);
```

#### Endpoints Utilizados

- `GET /api/campaigns` - Listar campañas
- `GET /api/campaign/{id}` - Obtener campaña específica
- `POST /api/campaign/add` - Crear campaña
- `PUT /api/campaign/{id}/update` - Actualizar campaña
- `DELETE /api/campaign/{id}/delete` - Eliminar campaña
- `POST /api/campaign/{id}/assign` - Asignar enlace a campaña

### 📺 Servicio de Canales

Segmenta tus enlaces por canales para mejor organización.

#### Métodos Disponibles

```php
// Obtener todos los canales
$channels = Enlace2::channels()->all();

// Obtener un canal específico
$channel = Enlace2::channels()->get($id);

// Crear un canal
$channel = Enlace2::channels()->create([
    'name' => 'Mi Canal',
    'description' => 'Descripción del canal',
    'color' => '#FF5733'  // Color del canal
]);

// Actualizar un canal
$updated = Enlace2::channels()->update($id, [
    'name' => 'Canal Actualizado',
    'color' => '#33FF57'
]);

// Eliminar un canal
Enlace2::channels()->delete($id);

// Asignar un elemento a un canal
Enlace2::channels()->assign($channelId, 'url', $itemId);
```

#### Endpoints Utilizados

- `GET /api/channels` - Listar canales
- `GET /api/channel/{id}` - Obtener canal específico
- `POST /api/channel/add` - Crear canal
- `PUT /api/channel/{id}/update` - Actualizar canal
- `DELETE /api/channel/{id}/delete` - Eliminar canal
- `POST /api/channel/{id}/assign` - Asignar elemento a canal

### 🌐 Servicio de Dominios de Marca

Gestiona tus dominios personalizados para URLs de marca.

#### Métodos Disponibles

```php
// Obtener todos los dominios
$domains = Enlace2::domains()->all();

// Obtener un dominio específico
$domain = Enlace2::domains()->get($id);

// Crear un dominio de marca
$domain = Enlace2::domains()->create([
    'domain' => 'https://mi-dominio.com',
    'redirect_root' => 'https://mi-sitio.com',
    'redirect_404' => 'https://mi-sitio.com/404'
]);

// Actualizar un dominio
$updated = Enlace2::domains()->update($id, [
    'redirect_root' => 'https://nuevo-sitio.com'
]);

// Eliminar un dominio
Enlace2::domains()->delete($id);
```

#### Endpoints Utilizados

- `GET /api/domains` - Listar dominios
- `GET /api/domain/{id}` - Obtener dominio específico
- `POST /api/domain/add` - Crear dominio
- `PUT /api/domain/{id}/update` - Actualizar dominio
- `DELETE /api/domain/{id}/delete` - Eliminar dominio

### 📊 Servicio de Píxeles

Integra píxeles de seguimiento para analytics avanzados.

#### Métodos Disponibles

```php
// Obtener todos los píxeles
$pixels = Enlace2::pixels()->all();

// Obtener un píxel específico
$pixel = Enlace2::pixels()->get($id);

// Crear un píxel
$pixel = Enlace2::pixels()->create([
    'name' => 'Mi Pixel',
    'type' => 'fbpixel',  // fbpixel, gtag, gtm
    'tag' => 'GTM-ABCDE'  // ID del píxel
]);

// Actualizar un píxel
$updated = Enlace2::pixels()->update($id, [
    'name' => 'Pixel Actualizado',
    'tag' => 'GTM-NUEVO'
]);

// Eliminar un píxel
Enlace2::pixels()->delete($id);
```

#### Endpoints Utilizados

- `GET /api/pixels` - Listar píxeles
- `GET /api/pixel/{id}` - Obtener píxel específico
- `POST /api/pixel/add` - Crear píxel
- `PUT /api/pixel/{id}/update` - Actualizar píxel
- `DELETE /api/pixel/{id}/delete` - Eliminar píxel

### 🎨 Servicio de Superposiciones CTA

Crea superposiciones de llamada a la acción para aumentar conversiones.

#### Métodos Disponibles

```php
// Obtener todas las superposiciones
$overlays = Enlace2::overlays()->all();

// Obtener una superposición específica
$overlay = Enlace2::overlays()->get($id);

// Crear una superposición CTA
$overlay = Enlace2::overlays()->create([
    'name' => 'Mi CTA',
    'type' => 'message',  // message, contact, form
    'title' => '¡Oferta Especial!',
    'message' => 'Descuento del 20% por tiempo limitado',
    'button_text' => 'Aprovechar Oferta',
    'button_url' => 'https://mi-sitio.com/oferta'
]);

// Actualizar una superposición
$updated = Enlace2::overlays()->update($id, [
    'title' => 'Nueva Oferta',
    'message' => 'Descuento del 30%'
]);

// Eliminar una superposición
Enlace2::overlays()->delete($id);
```

#### Endpoints Utilizados

- `GET /api/overlay` - Listar superposiciones
- `GET /api/overlay/{id}` - Obtener superposición específica
- `POST /api/overlay/add` - Crear superposición
- `PUT /api/overlay/{id}/update` - Actualizar superposición
- `DELETE /api/overlay/{id}/delete` - Eliminar superposición

## 🔧 Configuración Avanzada

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

    // Configuración de caché
    'cache' => [
        'enabled' => true,
        'ttl' => 3600,
        'store' => 'default',
        'prefix' => 'enlace2:',
    ],

    // Configuración de logging
    'logging' => [
        'enabled' => false,
        'channel' => 'default',
        'level' => 'info',
        'log_requests' => true,
        'log_responses' => false,
    ],
];
```

## ⚠️ Manejo de Errores

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
    echo 'Código de error: ' . $e->getCode();
    echo 'Datos adicionales: ' . json_encode($e->getContext());
}
```

## 📊 Rate Limiting

La API de Enlace2 tiene un límite de 30 solicitudes por minuto. El SDK maneja esto automáticamente:

```php
// Los headers de rate limiting están disponibles en las respuestas
$response = Enlace2::links()->all();

// Puedes acceder a los headers de rate limiting si necesitas
// X-RateLimit-Limit: 30
// X-RateLimit-Remaining: 29
// X-RateLimit-Reset: TIMESTAMP
```

## 🧪 Testing

Ejecuta los tests con:

```bash
composer test
```

Para generar coverage:

```bash
composer test-coverage
```

## 📈 Ejemplos de Uso Avanzado

### Crear una Campaña Completa

```php
// Crear campaña
$campaign = Enlace2::campaigns()->create([
    'name' => 'Black Friday 2024',
    'description' => 'Campaña de Black Friday'
]);

// Crear canal
$channel = Enlace2::channels()->create([
    'name' => 'Redes Sociales',
    'description' => 'Enlaces para redes sociales',
    'color' => '#FF6B6B'
]);

// Crear enlace con opciones avanzadas
$link = Enlace2::links()->shorten('https://mi-tienda.com/ofertas', [
    'custom' => 'black-friday-2024',
    'title' => 'Ofertas Black Friday',
    'description' => 'Las mejores ofertas del año',
    'password' => 'blackfriday2024',
    'expiry' => '2024-12-01 23:59:59'
]);

// Asignar enlace a campaña
Enlace2::campaigns()->assignLink($campaign['data']['id'], $link['data']['id']);

// Asignar enlace a canal
Enlace2::channels()->assign($channel['data']['id'], 'url', $link['data']['id']);

// Crear código QR para el enlace
$qr = Enlace2::qr()->create([
    'data' => $link['short'],
    'size' => 300,
    'name' => 'QR Black Friday'
]);
```

### Integración con Analytics

```php
// Crear píxel de Facebook
$pixel = Enlace2::pixels()->create([
    'name' => 'Facebook Pixel',
    'type' => 'fbpixel',
    'tag' => '123456789012345'
]);

// Crear superposición CTA
$overlay = Enlace2::overlays()->create([
    'name' => 'Oferta Especial',
    'type' => 'message',
    'title' => '¡Últimas horas!',
    'message' => 'Descuento del 50% por tiempo limitado',
    'button_text' => 'Comprar Ahora',
    'button_url' => 'https://mi-tienda.com/checkout'
]);
```

## 🔗 Enlaces Útiles

- **Documentación de la API**: [https://enlace2.com/developers](https://enlace2.com/developers)
- **Sitio Web**: [https://enlace2.com](https://enlace2.com)
- **Issues**: Reporta problemas en [GitHub](https://github.com/RenatoAscencio/enlace2/issues)
- **Packagist**: [https://packagist.org/packages/enlace2/laravel-url-shortener](https://packagist.org/packages/enlace2/laravel-url-shortener)

## 📝 Changelog

Ver [CHANGELOG.md](CHANGELOG.md) para un historial detallado de cambios.

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor, asegúrate de que tus cambios incluyan tests apropiados.

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este package es software de código abierto licenciado bajo la [Licencia MIT](LICENSE.md).

## 🆘 Soporte

- **Email**: Contacta el soporte de Enlace2
- **GitHub Issues**: Reporta problemas técnicos
- **Documentación**: Consulta la documentación oficial de la API

---

**Desarrollado con ❤️ por [Renato Ascencio](https://github.com/RenatoAscencio)**