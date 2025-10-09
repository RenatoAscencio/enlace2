# Guía Rápida de VSCode - Enlace2 ⚡

## 🎉 ¡Configuración Completa!

Tu entorno de VSCode está casi perfectamente configurado. Solo hay 3 advertencias menores.

---

## ✅ Estado Actual

### ✓ Instalado y Configurado (26 componentes)
- ✅ PHP 8.4.11
- ✅ Composer 2.8.11
- ✅ VSCode con CLI
- ✅ Git 2.50.1
- ✅ PHPUnit 10.5.55
- ✅ PHPStan 1.12.29
- ✅ PHP CodeSniffer 3.13.4
- ✅ PHPCBF
- ✅ Todas las extensiones críticas
- ✅ Todos los archivos de configuración

### ⚠️ Advertencias (3 items opcionales)
1. **Xdebug** - No instalado (opcional para debugging)
2. **PHPStan** - Hay algunos warnings (no críticos)
3. **Code Style** - Algunos errores de formato menores

---

## 🚀 Comenzar a Usar

### 1. Verificar Todo

```bash
# Ejecutar script de verificación
./.vscode/verify-setup.sh
```

### 2. Atajos de Teclado Esenciales

| Atajo | Acción |
|-------|--------|
| `Cmd+Shift+P` | Command Palette (acceso a todo) |
| `Cmd+P` | Quick Open (buscar archivos) |
| `F12` | Go to Definition |
| `Shift+F12` | Find All References |
| `Cmd+.` | Quick Fix |
| `F5` | Start Debugging |
| `Ctrl+Shift+B` | Run Tests (default) |
| `Cmd+K Cmd+R` | Run PHPUnit test actual |

### 3. Ejecutar Tests

**Opción 1: Desde Command Palette**
```
Cmd+Shift+P > "Tasks: Run Task" > "Run PHPUnit Tests"
```

**Opción 2: Atajo de teclado**
```
Ctrl+Shift+B (ejecuta tests por defecto)
```

**Opción 3: Better PHPUnit**
```
Cmd+K Cmd+R - Ejecutar test bajo el cursor
Cmd+K Cmd+F - Ejecutar todos los tests del archivo
```

**Opción 4: Terminal**
```bash
composer test
```

### 4. Snippets Rápidos

Escribe estos prefijos en un archivo PHP y presiona `Tab`:

| Prefijo | Expande a |
|---------|-----------|
| `phpclass` | Clase PHP completa con namespace |
| `phpservice` | Service class de Enlace2 |
| `phptest` | Método de test PHPUnit |
| `enlace2-shorten` | Código para acortar URL |
| `enlace2-qr` | Código para crear QR |
| `phpdoc` | DocBlock de método |

**Ejemplo:**
```php
// Escribe "phptest" y presiona Tab
public function test_can_do_something()
{
    // Arrange

    // Act

    // Assert
    $this->assertEquals(expected, actual);
}
```

### 5. Tareas Disponibles

Presiona `Cmd+Shift+P` y escribe "Tasks: Run Task":

- ✅ **Run PHPUnit Tests** - Ejecutar todos los tests
- 📊 **Run PHPUnit with Coverage** - Tests con coverage
- 🔍 **Run PHPStan Analysis** - Análisis estático
- 🎨 **Check Code Style** - Verificar estilo
- 🔧 **Fix Code Style** - Corregir estilo automáticamente
- 🏆 **Run Quality Checks (All)** - Todo junto
- 📦 **Install Dependencies** - composer install
- 🔄 **Update Dependencies** - composer update
- ✓ **Verify Setup** - Verificar configuración

---

## 🔧 Comandos Útiles de Terminal

```bash
# Testing
composer test                 # Todos los tests
composer test-coverage        # Con coverage HTML

# Calidad de código
composer phpstan             # Análisis estático
composer cs-check            # Verificar estilo
composer cs-fix              # Corregir estilo
composer quality             # Todo junto

# Composer
composer validate            # Validar composer.json
composer install             # Instalar dependencias
composer update              # Actualizar dependencias

# Herramientas directas
./vendor/bin/phpunit tests/Unit/LinkServiceTest.php  # Test específico
./vendor/bin/phpstan analyse src/                     # Analizar carpeta
./vendor/bin/phpcs src/Services/LinkService.php       # Check archivo
```

---

## 💡 Features Destacadas

### 1. Intelephense - Autocompletado Inteligente

- **Autocompletado**: Escribe `Enlace2::` y aparecen sugerencias
- **Go to Definition**: `F12` sobre cualquier clase/método
- **Find References**: `Shift+F12` para ver todos los usos
- **Rename Symbol**: `F2` para renombrar en todo el proyecto

**Ejemplo:**
```php
use Enlace2\LaravelUrlShortener\Facades\Enlace2;

// Escribe "Enlace2::" y verás:
// - links()
// - qr()
// - campaigns()
// - channels()
```

### 2. Better PHPUnit - Testing Rápido

**En cualquier archivo de test:**

1. Coloca el cursor en un método de test
2. Presiona `Cmd+K Cmd+R`
3. El test se ejecuta y ves resultados inmediatamente

### 3. GitLens - Historial de Código

- **Hover** sobre cualquier línea para ver el último commit
- **Code Lens** muestra autor y fecha sobre cada función
- Click en "Recent Changes" para ver diff completo

### 4. PHP Sniffer - Formato Automático

Al guardar cualquier archivo PHP:
- Se verifica el estilo automáticamente
- Los errores aparecen subrayados
- Los warnings aparecen en el panel de "Problems"

### 5. Todo Tree - Organización

- Sidebar muestra todos los TODOs del proyecto
- Click para ir directamente al código
- Filtra por tipo (TODO, FIXME, NOTE)

---

## 🐛 Solución Rápida de Problemas

### Intelephense no autocompleta

```
Cmd+Shift+P > "Developer: Reload Window"
```

### PHPUnit no encuentra tests

```bash
composer install  # Reinstalar dependencias
```

### Code Sniffer marca muchos errores

```bash
composer cs-fix  # Auto-fix automático
```

### VSCode está lento

```
Cmd+Shift+P > "Developer: Reload Window"
```

---

## 📚 Archivos de Documentación

- **[SETUP_GUIDE.md](.vscode/SETUP_GUIDE.md)** - Guía completa de configuración
- **[README.md](.vscode/README.md)** - Descripción de archivos de configuración
- **[VSCODE_EXTENSIONS.md](../VSCODE_EXTENSIONS.md)** - Lista detallada de extensiones
- **[CLAUDE.md](../CLAUDE.md)** - Guía del proyecto para Claude AI

---

## ⚠️ Próximos Pasos Opcionales

### 1. Instalar Xdebug (para debugging avanzado)

```bash
# macOS con Homebrew
brew install php@8.4-xdebug

# Verificar
php -m | grep xdebug
```

**Beneficios:**
- Debugging paso a paso
- Breakpoints
- Inspección de variables
- Coverage más preciso

### 2. Corregir Warnings de PHPStan

```bash
# Ver todos los errores
composer phpstan

# Son warnings menores, no críticos
# El proyecto funciona perfectamente
```

### 3. Corregir Estilo de Código

```bash
# Auto-fix de todos los errores
composer cs-fix

# O manualmente archivo por archivo
./vendor/bin/phpcbf src/Services/LinkService.php
```

---

## 🎓 Aprender Más

### VSCode
- **[VSCode PHP Docs](https://code.visualstudio.com/docs/languages/php)**
- **[VSCode Tips & Tricks](https://code.visualstudio.com/docs/getstarted/tips-and-tricks)**

### Extensiones
- **[Intelephense Docs](https://github.com/bmewburn/vscode-intelephense)**
- **[GitLens Guide](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens)**
- **[PHPUnit Guide](https://phpunit.de/documentation.html)**

### Laravel
- **[Laravel Docs](https://laravel.com/docs)**
- **[Laravel VSCode Tips](https://laravelshift.com/laravel-code-tips)**

---

## ✨ Tips Pro

### 1. Multi-cursor Editing

```
Cmd+D - Seleccionar siguiente ocurrencia
Cmd+Shift+L - Seleccionar todas las ocurrencias
Alt+Click - Agregar cursor
```

### 2. Quick Open con Símbolos

```
Cmd+P y luego:
@symbol - Buscar símbolos en archivo actual
#symbol - Buscar símbolos en workspace
:line - Ir a línea específica
```

### 3. Zen Mode

```
Cmd+K Z - Activar Zen Mode (pantalla completa sin distracciones)
```

### 4. Terminal Integrado

```
Ctrl+` - Toggle terminal
Cmd+Shift+` - Nueva terminal
```

### 5. Source Control

```
Ctrl+Shift+G - Abrir Source Control
Cmd+Enter - Commit (con mensaje en input)
```

---

## 🎯 Workflow Recomendado

### Desarrollando una Nueva Feature

1. **Crear branch**
   ```bash
   git checkout -b feature/mi-feature
   ```

2. **Escribir código** con autocompletado de Intelephense

3. **Escribir tests** usando snippet `phptest`

4. **Ejecutar tests** con `Cmd+K Cmd+R`

5. **Verificar estilo** (automático al guardar)

6. **Commit**
   ```
   Ctrl+Shift+G > Escribir mensaje > Cmd+Enter
   ```

7. **Push**
   ```bash
   git push -u origin feature/mi-feature
   ```

### Antes de Hacer Pull Request

```bash
# Verificar todo
./.vscode/verify-setup.sh

# O manualmente
composer quality  # Tests + PHPStan + CodeStyle
```

---

## 🎉 ¡Listo para Desarrollar!

Tu entorno está configurado y optimizado. Ahora puedes:

✅ Autocompletado inteligente
✅ Testing rápido
✅ Debugging (con Xdebug opcional)
✅ Análisis estático
✅ Formato automático
✅ Git integrado
✅ Snippets personalizados

**¡A programar!** 🚀

---

**Última actualización**: 2025-10-09
**Verificación**: ✅ 26 exitosos, 0 fallidos, 3 advertencias opcionales
