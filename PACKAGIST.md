# Publicación y Mantenimiento en Packagist

Guía completa para publicar y mantener el paquete **enlace2/laravel-url-shortener** en Packagist.

## 📋 Tabla de Contenidos

- [Pre-requisitos](#pre-requisitos)
- [Primera Publicación](#primera-publicación)
- [Versionado Semántico](#versionado-semántico)
- [Crear Nuevas Versiones](#crear-nuevas-versiones)
- [Webhooks de GitHub](#webhooks-de-github)
- [Badges para README](#badges-para-readme)
- [Mantenimiento](#mantenimiento)
- [Troubleshooting](#troubleshooting)

---

## 🔧 Pre-requisitos

### 1. Cuenta en Packagist

Si no tienes cuenta:

1. Ve a [https://packagist.org](https://packagist.org)
2. Click en "Sign Up with GitHub"
3. Autoriza Packagist a acceder a tu GitHub

### 2. Repositorio en GitHub

✅ **Ya está configurado**: `https://github.com/RenatoAscencio/enlace2`

### 3. Archivo composer.json Válido

Verifica que sea correcto:

```bash
composer validate
```

✅ **Debe pasar sin errores**

### 4. Verificación de Calidad

Antes de publicar:

```bash
# Ejecutar todos los checks
composer quality

# O individualmente
composer test          # Tests
composer phpstan       # Análisis estático
composer cs-check      # Estilo de código
```

---

## 🚀 Primera Publicación

### Paso 1: Iniciar Sesión en Packagist

1. Ve a [https://packagist.org](https://packagist.org)
2. Click en "Login with GitHub"

### Paso 2: Submit Package

1. Ve a [https://packagist.org/packages/submit](https://packagist.org/packages/submit)
2. Ingresa la URL del repositorio:
   ```
   https://github.com/RenatoAscencio/enlace2
   ```
3. Click en "Check"
4. Si todo está OK, click en "Submit"

### Paso 3: Verificación

Packagist verificará:
- ✅ composer.json existe y es válido
- ✅ El paquete tiene un nombre válido
- ✅ El repositorio es público
- ✅ Existe al menos un tag de versión

### Paso 4: Crear Primer Tag (Release)

Si no has creado un tag:

```bash
# Verificar que todo está commiteado
git status

# Crear tag para versión 1.0.1
git tag -a v1.0.1 -m "Release version 1.0.1

Primera versión estable del paquete Enlace2 para Laravel.

Features:
- Acortamiento de URLs
- Códigos QR
- Campañas
- Canales
- Documentación completa
- Tests 100% pasando
- Compatible con PHP 8.1-8.3
- Compatible con Laravel 9-11

🤖 Generated with Claude Code
"

# Subir tag a GitHub
git push origin v1.0.1
```

### Paso 5: Verificar en Packagist

1. Ve a `https://packagist.org/packages/enlace2/laravel-url-shortener`
2. Deberías ver tu versión publicada
3. Verifica que la información sea correcta

---

## 📦 Versionado Semántico

Este proyecto usa **[Semantic Versioning](https://semver.org/)**: `MAJOR.MINOR.PATCH`

### Formato: X.Y.Z

- **MAJOR (X)**: Cambios incompatibles con versiones anteriores
- **MINOR (Y)**: Nueva funcionalidad compatible con versiones anteriores
- **PATCH (Z)**: Bug fixes compatibles con versiones anteriores

### Ejemplos

```
1.0.0 → 1.0.1   Bug fix (Patch)
1.0.1 → 1.1.0   Nueva feature (Minor)
1.1.0 → 2.0.0   Breaking change (Major)
```

### Pre-releases

Para versiones de desarrollo:

```
1.0.0-alpha.1   Primera versión alpha
1.0.0-beta.1    Primera versión beta
1.0.0-rc.1      Release candidate
1.0.0           Versión estable
```

---

## 🎯 Crear Nuevas Versiones

### Workflow Completo

#### 1. Desarrolla y Testa

```bash
# Crear branch de feature
git checkout -b feature/mi-nueva-feature

# Desarrollar...
# ...

# Ejecutar tests
composer quality

# Commit
git commit -m "feat: add nueva feature"

# Push y crear PR
git push -u origin feature/mi-nueva-feature
```

#### 2. Merge a Main

```bash
# Después de aprobar PR, merge a main
git checkout main
git pull origin main
```

#### 3. Actualizar CHANGELOG

Edita `CHANGELOG.md` (créalo si no existe):

```markdown
# Changelog

All notable changes to `enlace2/laravel-url-shortener` will be documented in this file.

## [1.1.0] - 2025-10-09

### Added
- Nueva funcionalidad para colores personalizados en QR codes
- Soporte para webhooks en enlaces

### Fixed
- Bug en validación de URLs con parámetros
- Issue con rate limiting en requests concurrentes

### Changed
- Mejorada documentación de API
- Optimizado cacheo de respuestas

## [1.0.1] - 2025-10-09

### Fixed
- Compatibilidad con PHP 8.4
- Correcciones menores en tests

## [1.0.0] - 2025-01-XX

- Release inicial
```

#### 4. Actualizar composer.json (si cambió API)

Si hay breaking changes, actualiza las versiones requeridas si es necesario.

#### 5. Commit Cambios Pre-Release

```bash
git add CHANGELOG.md
git commit -m "chore: prepare release v1.1.0"
git push origin main
```

#### 6. Crear Tag y Release

```bash
# Crear tag anotado
git tag -a v1.1.0 -m "Release version 1.1.0

Added:
- Custom QR code colors
- Webhook support for links

Fixed:
- URL validation with parameters
- Rate limiting in concurrent requests

Changed:
- Improved API documentation
- Optimized response caching

🤖 Generated with Claude Code
"

# Push tag
git push origin v1.1.0
```

#### 7. Crear GitHub Release

**Opción A: Desde CLI con gh**

```bash
gh release create v1.1.0 \
  --title "v1.1.0 - Custom QR Colors & Webhooks" \
  --notes "## What's Changed

### ✨ New Features
- Custom QR code color support
- Webhook notifications for link events

### 🐛 Bug Fixes
- Fixed URL validation with query parameters
- Resolved rate limiting issues in concurrent requests

### 📝 Documentation
- Improved API documentation
- Updated examples

### ⚡ Performance
- Optimized response caching mechanism

**Full Changelog**: https://github.com/RenatoAscencio/enlace2/compare/v1.0.1...v1.1.0"
```

**Opción B: Desde GitHub UI**

1. Ve a `https://github.com/RenatoAscencio/enlace2/releases`
2. Click "Draft a new release"
3. Selecciona el tag `v1.1.0`
4. Título: `v1.1.0 - Custom QR Colors & Webhooks`
5. Descripción: Copia desde CHANGELOG
6. Click "Publish release"

#### 8. Verificar en Packagist

1. Ve a `https://packagist.org/packages/enlace2/laravel-url-shortener`
2. Espera ~10 minutos (webhook automático)
3. Verifica que aparezca la nueva versión

Si no aparece automáticamente:
- Click en "Update" en la página del paquete en Packagist

---

## 🔗 Webhooks de GitHub

Para que Packagist se actualice automáticamente:

### Configurar Webhook (Solo una vez)

1. Ve a tu repositorio en GitHub
2. Settings → Webhooks → Add webhook
3. Payload URL: `https://packagist.org/api/github?username=RenatoAscencio`
4. Content type: `application/json`
5. Secret: (déjalo en blanco)
6. SSL verification: Enable
7. Events: "Just the push event"
8. Active: ✅
9. Add webhook

**Nota**: Packagist puede configurar esto automáticamente. Ve a tu paquete en Packagist y busca la opción de GitHub integration.

---

## 🏷️ Badges para README

Añade estos badges a tu `README.md`:

```markdown
[![Latest Version on Packagist](https://img.shields.io/packagist/v/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Total Downloads](https://img.shields.io/packagist/dt/enlace2/laravel-url-shortener.svg?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Tests](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml/badge.svg)](https://github.com/RenatoAscencio/enlace2/actions/workflows/tests.yml)
[![PHP Version](https://img.shields.io/packagist/php-v/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
[![Laravel](https://img.shields.io/badge/Laravel-9%20%7C%2010%20%7C%2011-red?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/packagist/l/enlace2/laravel-url-shortener?style=flat-square)](https://packagist.org/packages/enlace2/laravel-url-shortener)
```

---

## 🔧 Mantenimiento

### Actualización Automática vs Manual

**Automática** (Con webhook configurado):
- Packagist se actualiza automáticamente con cada push a main
- Los tags se sincronizan automáticamente

**Manual**:
- Ve a tu paquete en Packagist
- Click en "Update"

### Estadísticas

Monitorea tu paquete:

1. **Downloads**: `https://packagist.org/packages/enlace2/laravel-url-shortener/stats`
2. **Dependents**: Ve qué proyectos usan tu paquete
3. **Stars**: Monitorea popularidad en GitHub

### Responder a Issues

1. Monitorea Issues en GitHub
2. Usa las plantillas que creamos
3. Etiqueta apropiadamente (`bug`, `enhancement`, etc.)
4. Comunica claramente los tiempos de resolución

### Pull Requests

1. Revisa el código
2. Ejecuta tests localmente
3. Verifica que pasen CI/CD
4. Merge solo si todo está verde

---

## 🐛 Troubleshooting

### "Package not found" después de publicar

**Causa**: El paquete no se ha indexado aún

**Solución**:
- Espera 10-15 minutos
- Verifica que el webhook esté configurado
- Fuerza actualización manual en Packagist

### "Could not find package"

**Causa**: Nombre incorrecto en composer.json

**Solución**:
```bash
# Verificar nombre
cat composer.json | grep "name"

# Debe ser: "enlace2/laravel-url-shortener"
```

### Versión no aparece en Packagist

**Causa**: Tag no pusheado o formato incorrecto

**Solución**:
```bash
# Verificar tags locales
git tag -l

# Verificar tags remotos
git ls-remote --tags origin

# Si falta, push:
git push origin v1.0.1
```

### GitHub webhook no funciona

**Solución**:
1. Ve a Settings → Webhooks en GitHub
2. Click en el webhook de Packagist
3. Ve a "Recent Deliveries"
4. Verifica que las requests sean exitosas (200 OK)
5. Si hay errores, reconfigura el webhook

### Tests fallan en CI pero pasan localmente

**Causa**: Diferencias de entorno

**Solución**:
```bash
# Verificar versiones
php -v
composer --version

# Limpiar cache
composer clear-cache
rm -rf vendor
composer install

# Ejecutar exactamente como CI
./vendor/bin/phpunit
```

---

## 📝 Checklist de Release

Usa este checklist para cada release:

### Pre-Release
- [ ] Tests pasan: `composer test`
- [ ] PHPStan sin errores: `composer phpstan`
- [ ] Code style correcto: `composer cs-check`
- [ ] Documentación actualizada
- [ ] CHANGELOG.md actualizado
- [ ] README.md actualizado si hay cambios de API
- [ ] composer.json actualizado si cambió metadata

### Release
- [ ] Commit pre-release: `git commit -m "chore: prepare release vX.Y.Z"`
- [ ] Push a main: `git push origin main`
- [ ] Crear tag: `git tag -a vX.Y.Z -m "Release vX.Y.Z"`
- [ ] Push tag: `git push origin vX.Y.Z`
- [ ] Crear GitHub Release con notas
- [ ] Verificar en Packagist (esperar ~10 min)

### Post-Release
- [ ] Verificar instalación: `composer require enlace2/laravel-url-shortener:^X.Y`
- [ ] Probar en proyecto limpio de Laravel
- [ ] Anunciar en redes sociales (opcional)
- [ ] Actualizar documentación externa si aplica

---

## 🎓 Recursos Adicionales

### Packagist
- [Packagist.org](https://packagist.org/)
- [Packagist Documentation](https://packagist.org/about)
- [Composer Documentation](https://getcomposer.org/doc/)

### Versionado
- [Semantic Versioning](https://semver.org/)
- [Keep a Changelog](https://keepachangelog.com/)

### GitHub
- [GitHub Releases](https://docs.github.com/en/repositories/releasing-projects-on-github)
- [GitHub Webhooks](https://docs.github.com/en/webhooks)

### Laravel Packages
- [Laravel Package Development](https://laravel.com/docs/packages)
- [Spatie Package Tools](https://github.com/spatie/laravel-package-tools)

---

## 📊 Ejemplo de Workflow Completo

```bash
# 1. Feature development
git checkout -b feature/custom-qr-colors
# ... develop ...
git commit -m "feat: add custom QR code colors"
git push -u origin feature/custom-qr-colors
# Create PR on GitHub, review, merge

# 2. Prepare release
git checkout main
git pull origin main

# Edit CHANGELOG.md
nano CHANGELOG.md

git add CHANGELOG.md
git commit -m "chore: prepare release v1.1.0"
git push origin main

# 3. Create tag and release
git tag -a v1.1.0 -m "Release version 1.1.0

Added custom QR code color support

🤖 Generated with Claude Code
"
git push origin v1.1.0

# 4. Create GitHub release
gh release create v1.1.0 --title "v1.1.0" --notes "See CHANGELOG.md"

# 5. Verify on Packagist
# Visit: https://packagist.org/packages/enlace2/laravel-url-shortener
# Wait ~10 minutes for webhook update

# 6. Test installation
cd ~/temp
composer create-project laravel/laravel test-app
cd test-app
composer require enlace2/laravel-url-shortener:^1.1

echo "✅ Release v1.1.0 published successfully!"
```

---

**Última actualización**: 2025-10-09
**Package**: enlace2/laravel-url-shortener
**Packagist**: https://packagist.org/packages/enlace2/laravel-url-shortener
**GitHub**: https://github.com/RenatoAscencio/enlace2
