# Contributing to Enlace2 Laravel Package

¡Gracias por tu interés en contribuir al proyecto Enlace2! 🎉

## 📋 Tabla de Contenidos

- [Código de Conducta](#código-de-conducta)
- [¿Cómo puedo contribuir?](#cómo-puedo-contribuir)
- [Configuración del Entorno](#configuración-del-entorno)
- [Proceso de Desarrollo](#proceso-de-desarrollo)
- [Estándares de Código](#estándares-de-código)
- [Proceso de Pull Request](#proceso-de-pull-request)
- [Reportar Bugs](#reportar-bugs)
- [Sugerir Mejoras](#sugerir-mejoras)

## 📜 Código de Conducta

Este proyecto y todos los que participan en él se rigen por nuestro Código de Conducta. Al participar, se espera que respetes este código.

## 🤝 ¿Cómo puedo contribuir?

### Reportar Bugs

Los bugs se rastrean como [GitHub issues](https://github.com/RenatoAscencio/enlace2/issues). Antes de crear un issue:

1. **Verifica** que el bug no haya sido reportado ya
2. **Determina** en qué repositorio debería ir el issue
3. **Usa** la plantilla de bug report

### Sugerir Mejoras

Las mejoras también se rastrean como GitHub issues. Para sugerir una mejora:

1. **Usa** una descripción clara y descriptiva
2. **Proporciona** ejemplos específicos para demostrar los pasos
3. **Describe** el comportamiento actual y el esperado
4. **Explica** por qué esta mejora sería útil

### Tu Primera Contribución de Código

¿No sabes por dónde empezar? Busca issues etiquetados como:

- `good first issue` - Issues que deberían requerir solo unas pocas líneas de código
- `help wanted` - Issues que necesitan ayuda de la comunidad

## 🛠️ Configuración del Entorno

### Requisitos

- PHP 8.1, 8.2 o 8.3
- Composer
- Git
- VSCode (recomendado)

### Instalación

1. **Fork el repositorio**
   ```bash
   # Haz fork desde GitHub UI
   ```

2. **Clona tu fork**
   ```bash
   git clone https://github.com/TU_USERNAME/enlace2.git
   cd enlace2
   ```

3. **Instala dependencias**
   ```bash
   composer install
   ```

4. **Configura VSCode** (opcional pero recomendado)
   ```bash
   # VSCode detectará automáticamente la configuración
   code .
   ```

5. **Verifica la instalación**
   ```bash
   ./.vscode/verify-setup.sh
   composer test
   ```

## 💻 Proceso de Desarrollo

### 1. Crea una Branch

```bash
git checkout -b feature/mi-nueva-feature
# o
git checkout -b fix/mi-bug-fix
```

**Convención de nombres de branches:**
- `feature/nombre-descriptivo` - Para nuevas características
- `fix/nombre-descriptivo` - Para bug fixes
- `docs/nombre-descriptivo` - Para documentación
- `refactor/nombre-descriptivo` - Para refactorización

### 2. Desarrolla tu Feature

- Escribe código siguiendo los [estándares](#estándares-de-código)
- Escribe tests para tu código
- Actualiza la documentación si es necesario
- Ejecuta tests frecuentemente

```bash
# Ejecutar tests
composer test

# Verificar estilo de código
composer cs-check

# Análisis estático
composer phpstan

# Todo junto
composer quality
```

### 3. Haz Commits

Usa mensajes de commit descriptivos siguiendo [Conventional Commits](https://www.conventionalcommits.org/):

```bash
git commit -m "feat: add support for custom QR code colors"
git commit -m "fix: resolve rate limiting issue in LinkService"
git commit -m "docs: update API usage examples"
```

**Tipos de commit:**
- `feat:` - Nueva característica
- `fix:` - Bug fix
- `docs:` - Cambios en documentación
- `style:` - Cambios de formato (no afectan el código)
- `refactor:` - Refactorización
- `test:` - Añadir o corregir tests
- `chore:` - Cambios en build process, herramientas, etc.

### 4. Push a tu Fork

```bash
git push -u origin feature/mi-nueva-feature
```

## 📏 Estándares de Código

### PHP

- **PSR-12**: Seguimos el estándar PSR-12
- **PHPStan Level 4**: El código debe pasar análisis estático
- **Type Hints**: Usa type hints siempre que sea posible
- **DocBlocks**: Documenta métodos públicos

```php
/**
 * Acorta una URL usando el servicio Enlace2
 *
 * @param string $url La URL a acortar
 * @param array<string, mixed> $options Opciones adicionales
 * @return array<string, mixed> Resultado con la URL acortada
 * @throws ApiException Si la API retorna un error
 */
public function shorten(string $url, array $options = []): array
{
    $this->validateUrl($url);
    return $this->client->makeRequest('POST', 'url/add', $options);
}
```

### Tests

- **Cobertura**: Apunta a >80% de cobertura de código
- **Nombres descriptivos**: Usa nombres claros para tests
- **AAA Pattern**: Arrange, Act, Assert

```php
public function test_can_shorten_url_with_custom_alias()
{
    // Arrange
    $url = 'https://example.com';
    $options = ['custom' => 'my-alias'];

    // Act
    $result = $this->service->shorten($url, $options);

    // Assert
    $this->assertArrayHasKey('short', $result);
    $this->assertStringContainsString('my-alias', $result['short']);
}
```

### Documentación

- **README**: Actualiza si añades funcionalidad
- **CLAUDE.md**: Actualiza si cambias arquitectura
- **Ejemplos**: Proporciona ejemplos de uso
- **Inline**: Comenta código complejo

## 🔍 Proceso de Pull Request

### Antes de Enviar

Asegúrate de que:

- [ ] Los tests pasan: `composer test`
- [ ] PHPStan no tiene errores: `composer phpstan`
- [ ] El código sigue el estilo: `composer cs-check`
- [ ] Actualizaste la documentación
- [ ] Añadiste tests para nueva funcionalidad
- [ ] Los commits siguen Conventional Commits
- [ ] No hay credenciales hardcodeadas
- [ ] El código es compatible con PHP 8.1+
- [ ] El código es compatible con Laravel 9-11

### Crear Pull Request

1. **Desde GitHub UI**, crea un Pull Request desde tu branch

2. **Completa la plantilla** de PR

3. **Vincula issues** relacionados

4. **Espera la revisión**

### Durante la Revisión

- Responde a los comentarios
- Haz cambios solicitados en la misma branch
- Push los cambios (se actualizan automáticamente)
- Marca conversaciones como resueltas

### Después de Aprobar

- Un mantenedor hará merge de tu PR
- Puedes eliminar tu branch
- ¡Celebra tu contribución! 🎉

## 🐛 Reportar Bugs

### Antes de Reportar

- **Verifica** que no sea un bug conocido
- **Determina** qué versión tiene el bug
- **Recolecta** información sobre el bug

### Cómo Reportar

Crea un issue con:

1. **Título claro**: Describe el problema brevemente
2. **Pasos para reproducir**: Lista paso a paso
3. **Comportamiento esperado**: Qué debería pasar
4. **Comportamiento actual**: Qué pasa realmente
5. **Entorno**: PHP version, Laravel version, OS
6. **Código de ejemplo**: Si es posible
7. **Screenshots**: Si aplica

**Ejemplo:**

```markdown
### Descripción
El método `shorten()` lanza excepción con URLs que contienen parámetros

### Pasos para reproducir
1. Instalar el paquete
2. Ejecutar: `Enlace2::links()->shorten('https://example.com?param=value')`
3. Ver error

### Comportamiento esperado
Debería acortar la URL correctamente

### Comportamiento actual
Lanza ApiException: "Invalid URL format"

### Entorno
- PHP: 8.2.10
- Laravel: 10.x
- Package: 1.0.1
- OS: macOS 14

### Código
\`\`\`php
$result = Enlace2::links()->shorten('https://example.com?utm_source=test');
// ApiException: Invalid URL format provided
\`\`\`
```

## 💡 Sugerir Mejoras

### Antes de Sugerir

- **Verifica** que no exista una sugerencia similar
- **Lee** la documentación para confirmar que no existe
- **Piensa** en el impacto de la mejora

### Cómo Sugerir

Crea un issue con:

1. **Título claro**: Describe la mejora brevemente
2. **Problema actual**: Qué limitación existe
3. **Solución propuesta**: Cómo lo resolverías
4. **Alternativas**: Otras soluciones consideradas
5. **Beneficios**: Por qué es útil
6. **Ejemplos**: Código de ejemplo si aplica

## 🎨 Guías de Estilo

### Git Commit Messages

- Usa presente ("Add feature" no "Added feature")
- Usa imperativo ("Move cursor to..." no "Moves cursor to...")
- Primera línea: máximo 72 caracteres
- Referencia issues y PRs cuando aplique

```bash
# Bueno
feat: add QR code color customization

Allows users to specify custom colors for QR codes.
Closes #123

# Malo
Added colors
```

### PHP Style

```php
// Bueno
public function shortenUrl(string $url, array $options = []): array
{
    $this->validateUrl($url);

    $data = array_merge(['url' => $url], $options);

    return $this->client->makeRequest('POST', 'url/add', $data);
}

// Malo
public function shortenUrl($url,$options=[])
{
$this->validateUrl($url);
$data=array_merge(['url'=>$url],$options);
return $this->client->makeRequest('POST','url/add',$data);
}
```

## 📚 Recursos Adicionales

- [Documentación del Proyecto](../CLAUDE.md)
- [Guía de VSCode](.vscode/QUICK_START.md)
- [API de Enlace2](https://enlace2.com/developers)
- [PSR-12](https://www.php-fig.org/psr/psr-12/)
- [Conventional Commits](https://www.conventionalcommits.org/)

## ❓ Preguntas

¿Tienes preguntas? Crea un issue con la etiqueta `question`.

## 🙏 Agradecimientos

¡Gracias por contribuir al proyecto Enlace2! Cada contribución, sin importar su tamaño, es valiosa.

---

**Última actualización**: 2025-10-09
