# API Endpoints Reference - Enlace2 Laravel Package

Esta documentación detalla todos los endpoints de la API de Enlace2 que están disponibles en el SDK de Laravel.

## 📋 Tabla de Contenidos

- [Autenticación](#autenticación)
- [Enlaces (Links)](#enlaces-links)
- [Códigos QR](#códigos-qr)
- [Campañas](#campañas)
- [Canales](#canales)
- [Dominios de Marca](#dominios-de-marca)
- [Píxeles](#píxeles)
- [Superposiciones CTA](#superposiciones-cta)
- [Cuenta](#cuenta)
- [Rate Limiting](#rate-limiting)
- [Códigos de Error](#códigos-de-error)

## 🔐 Autenticación

Todas las peticiones requieren autenticación mediante Bearer Token:

```http
Authorization: Bearer YOUR_API_KEY
Content-Type: application/json
```

### Obtener Información de Cuenta

```http
GET /api/account
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "id": 1,
        "email": "usuario@ejemplo.com",
        "username": "Usuario",
        "avatar": "https://enlace2.com/content/avatar/profile.png",
        "status": "pro",
        "planid": "4",
        "expires": "2030-05-14 00:00:00",
        "registered": "2020-05-16 11:39:28"
    }
}
```

## 🔗 Enlaces (Links)

### Listar Enlaces

```http
GET /api/urls?limit=15&page=1
```

**Parámetros:**
- `limit` (opcional): Número de resultados por página (default: 15)
- `page` (opcional): Página actual (default: 1)

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 1036,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": 2,
        "maxpage": 70,
        "urls": [
            {
                "id": 1717,
                "alias": "nnQCK",
                "shorturl": "https://enlace2.com/nnQCK",
                "longurl": "https://www.google.com",
                "title": "Google",
                "description": "",
                "clicks": "13",
                "uniqueclicks": "12",
                "domain": "https://enlace2.com",
                "campaign": null,
                "channel": [],
                "date": "2025-10-02 19:57:20"
            }
        ]
    }
}
```

### Obtener Enlace Específico

```http
GET /api/link/{id}
```

### Crear/Acortar Enlace

```http
POST /api/url/add
```

**Payload:**
```json
{
    "url": "https://example.com",
    "custom": "mi-enlace-personalizado",
    "password": "mi-password",
    "expiry": "2024-12-31 23:59:59",
    "title": "Mi Enlace",
    "description": "Descripción del enlace",
    "domain": "https://mi-dominio.com"
}
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "id": 1718,
        "alias": "mi-enlace-personalizado",
        "shorturl": "https://mi-dominio.com/mi-enlace-personalizado",
        "longurl": "https://example.com",
        "title": "Mi Enlace",
        "description": "Descripción del enlace",
        "clicks": "0",
        "uniqueclicks": "0",
        "domain": "https://mi-dominio.com",
        "campaign": null,
        "channel": [],
        "date": "2025-01-27 12:00:00"
    }
}
```

### Actualizar Enlace

```http
PUT /api/link/{id}/update
```

**Payload:**
```json
{
    "url": "https://nueva-url.com",
    "title": "Nuevo Título",
    "description": "Nueva descripción"
}
```

### Eliminar Enlace

```http
DELETE /api/link/{id}/delete
```

## 📱 Códigos QR

### Listar Códigos QR

```http
GET /api/qr?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 10,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "qrs": [
            {
                "id": "1",
                "name": "Mi QR Code",
                "link": "https://enlace2.com/qr/5b258b",
                "scans": "0",
                "date": "2021-12-30 14:10:58"
            }
        ]
    }
}
```

### Obtener Código QR Específico

```http
GET /api/qr/{id}
```

### Crear Código QR

```http
POST /api/qr/add
```

**Payload:**
```json
{
    "data": "https://example.com",
    "size": 200,
    "name": "Mi QR Code",
    "format": "png"
}
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "id": "11",
        "name": "Mi QR Code",
        "link": "https://enlace2.com/qr/abc123",
        "scans": "0",
        "date": "2025-01-27 12:00:00"
    }
}
```

### Actualizar Código QR

```http
PUT /api/qr/{id}/update
```

**Payload:**
```json
{
    "size": 300,
    "name": "QR Actualizado"
}
```

### Eliminar Código QR

```http
DELETE /api/qr/{id}/delete
```

## 🎯 Campañas

### Listar Campañas

```http
GET /api/campaigns?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 2,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "campaigns": [
            {
                "id": 1,
                "name": "Sample Campaign",
                "public": false,
                "rotator": false,
                "list": "https://domain.com/u/admin/list-1"
            }
        ]
    }
}
```

### Obtener Campaña Específica

```http
GET /api/campaign/{id}
```

### Crear Campaña

```http
POST /api/campaign/add
```

**Payload:**
```json
{
    "name": "Mi Campaña",
    "description": "Descripción de la campaña"
}
```

### Actualizar Campaña

```http
PUT /api/campaign/{id}/update
```

**Payload:**
```json
{
    "name": "Campaña Actualizada",
    "description": "Nueva descripción"
}
```

### Eliminar Campaña

```http
DELETE /api/campaign/{id}/delete
```

### Asignar Enlace a Campaña

```http
POST /api/campaign/{id}/assign
```

**Payload:**
```json
{
    "link_id": 123
}
```

## 📺 Canales

### Listar Canales

```http
GET /api/channels?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 3,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "channels": [
            {
                "id": 1,
                "name": "PSR",
                "description": "Patines Sobre Ruedas",
                "color": "#000000",
                "starred": true
            }
        ]
    }
}
```

### Obtener Canal Específico

```http
GET /api/channel/{id}
```

### Crear Canal

```http
POST /api/channel/add
```

**Payload:**
```json
{
    "name": "Mi Canal",
    "description": "Descripción del canal",
    "color": "#FF5733"
}
```

### Actualizar Canal

```http
PUT /api/channel/{id}/update
```

**Payload:**
```json
{
    "name": "Canal Actualizado",
    "color": "#33FF57"
}
```

### Eliminar Canal

```http
DELETE /api/channel/{id}/delete
```

### Asignar Elemento a Canal

```http
POST /api/channel/{id}/assign
```

**Payload:**
```json
{
    "type": "url",
    "item_id": 123
}
```

## 🌐 Dominios de Marca

### Listar Dominios

```http
GET /api/domains?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 6,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "domains": [
            {
                "id": "5",
                "domain": "https://mi-dominio.com",
                "redirectroot": "https://www.mi-sitio.com",
                "redirect404": "https://www.mi-sitio.com"
            }
        ]
    }
}
```

### Obtener Dominio Específico

```http
GET /api/domain/{id}
```

### Crear Dominio

```http
POST /api/domain/add
```

**Payload:**
```json
{
    "domain": "https://mi-dominio.com",
    "redirect_root": "https://mi-sitio.com",
    "redirect_404": "https://mi-sitio.com/404"
}
```

### Actualizar Dominio

```http
PUT /api/domain/{id}/update
```

**Payload:**
```json
{
    "redirect_root": "https://nuevo-sitio.com"
}
```

### Eliminar Dominio

```http
DELETE /api/domain/{id}/delete
```

## 📊 Píxeles

### Listar Píxeles

```http
GET /api/pixels?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 1,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "pixels": [
            {
                "id": "1",
                "type": "fbpixel",
                "name": "Mi Pixel",
                "tag": "722762351862655",
                "date": "2023-04-09 23:54:01"
            }
        ]
    }
}
```

### Obtener Píxel Específico

```http
GET /api/pixel/{id}
```

### Crear Píxel

```http
POST /api/pixel/add
```

**Payload:**
```json
{
    "name": "Mi Pixel",
    "type": "fbpixel",
    "tag": "GTM-ABCDE"
}
```

### Actualizar Píxel

```http
PUT /api/pixel/{id}/update
```

**Payload:**
```json
{
    "name": "Pixel Actualizado",
    "tag": "GTM-NUEVO"
}
```

### Eliminar Píxel

```http
DELETE /api/pixel/{id}/delete
```

## 🎨 Superposiciones CTA

### Listar Superposiciones

```http
GET /api/overlay?limit=15&page=1
```

**Respuesta:**
```json
{
    "error": 0,
    "data": {
        "result": 1,
        "perpage": 15,
        "currentpage": 1,
        "nextpage": null,
        "maxpage": 1,
        "overlay": [
            {
                "id": "1",
                "type": "message",
                "name": "DESCUENTO",
                "date": "2020-05-18 04:07:55"
            }
        ]
    }
}
```

### Obtener Superposición Específica

```http
GET /api/overlay/{id}
```

### Crear Superposición

```http
POST /api/overlay/add
```

**Payload:**
```json
{
    "name": "Mi CTA",
    "type": "message",
    "title": "¡Oferta Especial!",
    "message": "Descuento del 20% por tiempo limitado",
    "button_text": "Aprovechar Oferta",
    "button_url": "https://mi-sitio.com/oferta"
}
```

### Actualizar Superposición

```http
PUT /api/overlay/{id}/update
```

**Payload:**
```json
{
    "title": "Nueva Oferta",
    "message": "Descuento del 30%"
}
```

### Eliminar Superposición

```http
DELETE /api/overlay/{id}/delete
```

## ⚡ Rate Limiting

La API de Enlace2 tiene un límite de **30 solicitudes por minuto**.

### Headers de Rate Limiting

Cada respuesta incluye headers informativos:

```http
X-RateLimit-Limit: 30
X-RateLimit-Remaining: 29
X-RateLimit-Reset: 1640995200
```

### Manejo de Rate Limiting

Cuando se alcanza el límite, la API devuelve:

```http
HTTP/1.1 429 Too Many Requests
```

```json
{
    "error": 1,
    "message": "Rate limit exceeded"
}
```

## ❌ Códigos de Error

### Códigos de Estado HTTP

- `200` - OK
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `429` - Too Many Requests
- `500` - Internal Server Error

### Estructura de Error

```json
{
    "error": 1,
    "message": "Descripción del error",
    "code": 400,
    "details": {
        "field": "url",
        "reason": "Invalid URL format"
    }
}
```

### Errores Comunes

| Código | Mensaje | Descripción |
|--------|---------|-------------|
| 400 | Invalid URL | La URL proporcionada no es válida |
| 400 | Custom alias already exists | El alias personalizado ya existe |
| 401 | Invalid API key | La API key no es válida |
| 404 | Resource not found | El recurso solicitado no existe |
| 429 | Rate limit exceeded | Se alcanzó el límite de solicitudes |

## 🔧 Ejemplos de Uso con cURL

### Crear un Enlace

```bash
curl -X POST 'https://enlace2.com/api/url/add' \
  -H 'Authorization: Bearer YOUR_API_KEY' \
  -H 'Content-Type: application/json' \
  -d '{
    "url": "https://example.com",
    "custom": "mi-enlace",
    "title": "Mi Enlace"
  }'
```

### Obtener Información de Cuenta

```bash
curl -X GET 'https://enlace2.com/api/account' \
  -H 'Authorization: Bearer YOUR_API_KEY' \
  -H 'Content-Type: application/json'
```

### Listar Enlaces

```bash
curl -X GET 'https://enlace2.com/api/urls?limit=10&page=1' \
  -H 'Authorization: Bearer YOUR_API_KEY' \
  -H 'Content-Type: application/json'
```

## 📚 Recursos Adicionales

- [Documentación Oficial de Enlace2](https://enlace2.com/developers)
- [SDK de Laravel](https://github.com/RenatoAscencio/enlace2)
- [Packagist](https://packagist.org/packages/enlace2/laravel-url-shortener)

---

**Última actualización**: Enero 2025  
**Versión del SDK**: 1.2.0
