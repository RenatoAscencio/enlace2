# CLAUDE.md - Guía para Claude AI

## Información del Proyecto

**Nombre**: Enlace2 Laravel Package
**Tipo**: Paquete de Laravel / Librería PHP
**Descripción**: Paquete completo de Laravel para integrar el servicio de acortamiento de URLs de Enlace2. Proporciona un wrapper completo de la API con soporte para enlaces, códigos QR, campañas, canales y todas las funcionalidades avanzadas de la API de Enlace2.

## Contexto Técnico

### Stack Tecnológico
- **PHP**: 8.1, 8.2, 8.3+
- **Laravel**: 9.x, 10.x, 11.x
- **HTTP Client**: Guzzle 7.0+
- **Testing**: PHPUnit 9.0+/10.0+
- **Análisis Estático**: PHPStan (Level 4)
- **Code Style**: PHP_CodeSniffer + PHP-CS-Fixer

### Dependencias Principales
```json
{
  "guzzlehttp/guzzle": "^7.0",
  "illuminate/support": "^9.0|^10.0|^11.0"
}
```

### Estructura del Proyecto

```
enlace2/
├── src/
│   ├── Services/          # Servicios principales de la API
│   │   ├── Enlace2Client.php      # Cliente HTTP principal
│   │   ├── LinkService.php        # Gestión de enlaces
│   │   ├── QrService.php          # Gestión de códigos QR
│   │   ├── CampaignService.php    # Gestión de campañas
│   │   └── ChannelService.php     # Gestión de canales
│   ├── Models/            # Modelos de datos
│   │   ├── Link.php
│   │   ├── QrCode.php
│   │   ├── Campaign.php
│   │   └── Channel.php
│   ├── Traits/            # Traits reutilizables
│   │   ├── ValidatesInput.php     # Validación de entrada
│   │   ├── LogsActivity.php       # Logging de actividad
│   │   └── CachesResponses.php    # Cacheo de respuestas
│   ├── Exceptions/        # Excepciones personalizadas
│   │   ├── Enlace2Exception.php
│   │   ├── ApiException.php
│   │   └── RateLimitException.php
│   ├── Facades/
│   │   └── Enlace2.php    # Facade de Laravel
│   └── Enlace2ServiceProvider.php
├── config/
│   └── enlace2.php        # Configuración del paquete
├── tests/
│   ├── Unit/              # Tests unitarios
│   └── Integration/       # Tests de integración
├── examples/              # Ejemplos de uso
└── .github/
    └── workflows/         # CI/CD con GitHub Actions
```

## Arquitectura y Patrones

### Patrón de Diseño Principal
El paquete sigue el patrón **Service Layer** con los siguientes componentes:

1. **Client Layer** (`Enlace2Client`): Maneja la comunicación HTTP con la API
2. **Service Layer** (`LinkService`, `QrService`, etc.): Implementa la lógica de negocio
3. **Traits**: Proporcionan funcionalidad transversal (validación, logging, caching)
4. **Exceptions**: Manejo de errores específico del dominio

### Características Principales

#### 1. Gestión de Enlaces
```php
// Acortar URL
$result = Enlace2::links()->shorten('https://example.com', [
    'custom' => 'mi-enlace',
    'password' => 'secret',
    'expiry' => '2024-12-31 23:59:59'
]);

// CRUD completo
$links = Enlace2::links()->all();
$link = Enlace2::links()->get($id);
$updated = Enlace2::links()->update($id, $data);
Enlace2::links()->delete($id);
```

#### 2. Códigos QR
```php
$qr = Enlace2::qr()->create([
    'data' => 'https://example.com',
    'size' => 200
]);
```

#### 3. Campañas y Canales
```php
// Campañas para organizar enlaces
$campaign = Enlace2::campaigns()->create([
    'name' => 'Mi Campaña',
    'description' => 'Descripción'
]);

// Canales para segmentación
$channel = Enlace2::channels()->create([
    'name' => 'Mi Canal'
]);
```

## Guías de Desarrollo

### Para Añadir Nueva Funcionalidad

1. **Nuevo Servicio**:
   - Crear clase en `src/Services/`
   - Implementar traits necesarios (`ValidatesInput`, `CachesResponses`)
   - Añadir método accessor en `Enlace2Client`
   - Crear tests en `tests/Unit/`

2. **Nueva Validación**:
   - Añadir método en `ValidatesInput` trait
   - Llamar desde el servicio correspondiente
   - Añadir tests de validación

3. **Nuevo Endpoint de API**:
   - Añadir método en el servicio correspondiente
   - Usar `$this->client->makeRequest()` para llamadas HTTP
   - Implementar validación de entrada
   - Añadir cacheo si es necesario (solo lectura)

### Para Modificar Código Existente

#### Servicios (`src/Services/`)
- Todos los servicios reciben `Enlace2Client` en el constructor
- Usan traits para funcionalidad compartida
- Métodos públicos son la interfaz principal
- Validación se realiza antes de llamadas HTTP

#### Configuración (`config/enlace2.php`)
Configuración completa disponible para:
- Autenticación (API key)
- Timeouts y rate limiting
- Cacheo de respuestas
- Reintentos con backoff exponencial
- Logging de requests/responses
- Validación de URLs

#### Manejo de Errores
```php
try {
    $result = Enlace2::links()->shorten('https://example.com');
} catch (RateLimitException $e) {
    // Rate limit: 30 requests/minuto
} catch (ApiException $e) {
    // Error general de API
    $code = $e->getCode();
    $response = $e->getResponse();
}
```

## Testing

### Ejecutar Tests
```bash
# Todos los tests
composer test

# Con coverage
composer test-coverage

# Solo unitarios
vendor/bin/phpunit tests/Unit

# Solo integración
vendor/bin/phpunit tests/Integration
```

### Análisis de Código
```bash
# PHPStan (análisis estático)
composer phpstan

# Code style check
composer cs-check

# Code style fix
composer cs-fix

# Todo el análisis de calidad
composer quality
```

### Escribir Nuevos Tests

**Tests Unitarios** (`tests/Unit/`):
- Mock del cliente HTTP
- Verificar lógica de negocio
- Validar transformaciones de datos

**Tests de Integración** (`tests/Integration/`):
- Requieren API key real (opcional)
- Verifican integración con Laravel
- Prueban flujos completos

Ejemplo de test:
```php
public function test_can_shorten_url()
{
    $result = $this->client->links()->shorten('https://google.com');

    $this->assertArrayHasKey('short', $result);
    $this->assertArrayHasKey('id', $result);
}
```

## CI/CD

### GitHub Actions
El proyecto usa GitHub Actions para CI/CD (`.github/workflows/tests.yml`):

**Matrix Testing**:
- PHP: 8.1, 8.2, 8.3
- Laravel: 9.*, 10.*, 11.*
- Stability: prefer-lowest, prefer-stable

**Pipeline**:
1. Checkout código
2. Setup PHP con extensiones
3. Instalar dependencias
4. Ejecutar tests con coverage
5. PHPStan analysis (allow failures)
6. Code style check (allow failures)
7. Upload coverage a Codecov

## Consideraciones Importantes

### Seguridad
- **API Key**: Nunca commitear en código. Usar `.env`
- **Rate Limiting**: 30 requests/minuto (configurable)
- **Validación**: Todas las URLs e inputs se validan
- **HTTPS**: Solo protocolos seguros por defecto

### Performance
- **Cacheo**: Respuestas GET cacheadas (configurable)
- **Timeout**: 30 segundos por defecto
- **Reintentos**: 3 intentos con backoff exponencial
- **Lazy Loading**: Servicios se instancian bajo demanda

### Compatibilidad
- **PHP 8.1+**: Uso de typed properties y mixed types
- **Laravel 9-11**: Service provider auto-discovery
- **Uso Standalone**: Funciona sin Laravel (solo con Composer)

## Comandos Útiles

```bash
# Desarrollo
composer install                    # Instalar dependencias
composer validate                   # Validar composer.json
php examples/basic_usage.php KEY    # Ejecutar ejemplo básico

# Calidad
composer test                       # Tests
composer phpstan                    # Análisis estático
composer quality                    # Test + PHPStan + CS
composer fix                        # Fix code style

# Publicación
composer update                     # Actualizar dependencias
git tag v1.x.x                     # Crear tag de versión
```

## Endpoints de API Soportados

### Links
- `GET /urls` - Listar todos los enlaces
- `GET /url/{id}` - Obtener enlace específico
- `POST /url/add` - Crear enlace
- `PUT /url/{id}/update` - Actualizar enlace
- `DELETE /url/{id}/delete` - Eliminar enlace

### QR Codes
- `GET /qr` - Listar QR codes
- `POST /qr/add` - Crear QR code
- `PUT /qr/{id}/update` - Actualizar QR
- `DELETE /qr/{id}/delete` - Eliminar QR

### Campaigns
- `GET /campaigns` - Listar campañas
- `POST /campaign/add` - Crear campaña
- `PUT /campaign/{id}/update` - Actualizar
- `DELETE /campaign/{id}/delete` - Eliminar

### Channels
- `GET /channels` - Listar canales
- `POST /channel/add` - Crear canal
- `PUT /channel/{id}/update` - Actualizar
- `DELETE /channel/{id}/delete` - Eliminar

## Variables de Entorno

```env
# Requerido
ENLACE2_API_KEY=tu_api_key_aqui

# Opcional
ENLACE2_BASE_URL=https://enlace2.com/api/
ENLACE2_TIMEOUT=30
ENLACE2_RATE_LIMITING=true

# Cacheo
ENLACE2_CACHE_ENABLED=true
ENLACE2_CACHE_TTL=3600
ENLACE2_CACHE_STORE=default
ENLACE2_CACHE_PREFIX=enlace2:

# Logging
ENLACE2_LOGGING_ENABLED=false
ENLACE2_LOG_CHANNEL=default
ENLACE2_LOG_LEVEL=info

# Validación
ENLACE2_STRICT_URL_VALIDATION=true
ENLACE2_MAX_URL_LENGTH=2048
```

## Recursos Adicionales

- **Repositorio**: https://github.com/RenatoAscencio/enlace2
- **Packagist**: https://packagist.org/packages/enlace2/laravel-url-shortener
- **API Docs**: https://enlace2.com/developers
- **Issues**: https://github.com/RenatoAscencio/enlace2/issues

## Checklist para Pull Requests

Antes de enviar un PR, asegúrate de:

- [ ] Tests pasan: `composer test`
- [ ] PHPStan sin errores críticos: `composer phpstan`
- [ ] Code style correcto: `composer cs-check`
- [ ] Documentación actualizada si es necesario
- [ ] Ejemplos funcionan si se añadió funcionalidad nueva
- [ ] CHANGELOG.md actualizado
- [ ] Tests cubren la nueva funcionalidad
- [ ] No hay credenciales hardcodeadas
- [ ] Compatible con PHP 8.1, 8.2, 8.3
- [ ] Compatible con Laravel 9, 10, 11

## Notas Específicas para Claude

### Al Modificar Código:
1. **Mantener compatibilidad**: PHP 8.1+ y Laravel 9-11
2. **Preservar arquitectura**: Service Layer pattern
3. **Usar traits existentes**: `ValidatesInput`, `LogsActivity`, `CachesResponses`
4. **Validar inputs**: Siempre antes de llamadas API
5. **Escribir tests**: Para cada nueva funcionalidad
6. **Documentar cambios**: En código y en README si es relevante

### Al Añadir Funcionalidad:
1. Seguir la estructura de servicios existentes
2. Implementar en el servicio apropiado
3. Añadir validación específica
4. Considerar cacheo para operaciones de lectura
5. Actualizar facade si es necesario
6. Crear tests unitarios y de integración
7. Actualizar ejemplos si aplica

### Prioridades:
1. **Seguridad**: Validación y manejo de API keys
2. **Compatibilidad**: Multi-versión PHP/Laravel
3. **Testing**: Cobertura completa
4. **Documentación**: Clara y actualizada
5. **Performance**: Cacheo y optimizaciones

---

**Última actualización**: 2025-10-09
**Versión del paquete**: 1.0.1
