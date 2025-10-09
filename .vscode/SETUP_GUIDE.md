# Guía de Configuración de VSCode - Enlace2

Esta guía te ayudará a verificar y configurar correctamente todas las extensiones de VSCode para el proyecto Enlace2.

## ✅ Verificación de Extensiones Instaladas

Ya tienes instaladas las siguientes extensiones clave:

### ✓ PHP Esenciales
- ✅ **Intelephense** (`bmewburn.vscode-intelephense-client`)
- ✅ **PHP Debug** (`xdebug.php-debug`)
- ✅ **PHP IntelliSense** (`zobo.php-intellisense`)

### ✓ Laravel
- ✅ **Laravel Extra Intellisense** (`amiralizadeh9480.laravel-extra-intellisense`)
- ✅ **Laravel Blade** (`onecentlin.laravel-blade`)
- ✅ **Laravel 5 Snippets** (`onecentlin.laravel5-snippets`)
- ✅ **Laravel Goto View** (`codingyu.laravel-goto-view`)
- ✅ **Laravel Extension Pack** (`onecentlin.laravel-extension-pack`)

### ✓ Calidad de Código
- ✅ **PHP Sniffer** (`wongjn.php-sniffer`)
- ✅ **PHP CS Fixer** (`junstyle.php-cs-fixer`)
- ⚠️ **PHPStan** - No hay extensión específica pero está configurado

### ✓ Testing
- ✅ **PHPUnit** (`recca0120.vscode-phpunit`)
- ✅ **Better PHPUnit** (`calebporzio.better-phpunit`)

### ✓ Git
- ✅ **GitLens** (`eamodio.gitlens`)
- ✅ **Git History** (`donjayamanne.githistory`)
- ✅ **Git Graph** (`mhutchie.git-graph`)

### ✓ Utilidades
- ✅ **EditorConfig** (`editorconfig.editorconfig`)
- ✅ **Prettier** (`esbenp.prettier-vscode`)
- ✅ **Todo Tree** (`gruntfuggly.todo-tree`)
- ✅ **Todo Highlight** (`wayou.vscode-todo-highlight`)
- ✅ **Better Comments** (`aaron-bond.better-comments`)
- ✅ **Code Spell Checker** (`streetsidesoftware.code-spell-checker`)
- ✅ **Path Intellisense** (`christian-kohler.path-intellisense`)
- ✅ **REST Client** (`humao.rest-client`)

---

## 🔧 Configuración Paso a Paso

### 1. Intelephense (Ya configurado ✓)

**Status**: ✅ Configurado correctamente

**Configuración actual**:
- Telemetría: Deshabilitada
- Formato automático: Habilitado
- Auto-import: Habilitado
- Exclusiones: vendor/tests, .git, node_modules

**Para verificar**:
1. Abre cualquier archivo PHP del proyecto
2. Intenta autocompletar escribiendo `Enlace2::`
3. Deberías ver sugerencias de métodos

**Opcional - Licencia Premium ($15)**:
- Ir a: https://intelephense.com/
- Comprar licencia
- En VSCode: `Cmd+Shift+P` > "Intelephense: Enter License Key"

---

### 2. PHPStan (Ya configurado ✓)

**Status**: ✅ Configurado correctamente

**Configuración actual**:
```json
"phpstan.path": "${workspaceFolder}/vendor/bin/phpstan",
"phpstan.configFile": "${workspaceFolder}/phpstan.neon",
"phpstan.level": "4"
```

**Para verificar**:
1. Abre `src/Services/Enlace2Client.php`
2. La barra de estado inferior debería mostrar "PHPStan"
3. Si hay errores de análisis, aparecerán subrayados

**Para ejecutar manualmente**:
```bash
composer phpstan
# o
./vendor/bin/phpstan analyse
```

---

### 3. PHP CodeSniffer (Ya configurado ✓)

**Status**: ✅ Configurado correctamente

**Configuración actual**:
- Se ejecuta automáticamente al guardar
- Usa el archivo `.phpcs.xml` del proyecto
- Standard: PSR-12

**Para verificar**:
1. Abre cualquier archivo PHP
2. Introduce un error de estilo (por ejemplo, 3 espacios en lugar de 4)
3. Al guardar, debería marcarse el error
4. Los errores aparecen como "squiggly lines" amarillos/rojos

**Para ejecutar manualmente**:
```bash
composer cs-check
# o para auto-fix
composer cs-fix
```

---

### 4. PHP CS Fixer (Ya configurado ✓)

**Status**: ✅ Configurado

**Configuración actual**:
- NO se ejecuta automáticamente al guardar (para evitar conflictos con PHPCS)
- Usa standard PSR-12

**Para ejecutar manualmente**:
```bash
composer php-cs-fixer-fix
```

---

### 5. PHPUnit (Ya configurado ✓)

**Status**: ✅ Configurado correctamente

Tienes DOS extensiones de PHPUnit instaladas:
1. **PHPUnit** (recca0120) - Test explorer con UI
2. **Better PHPUnit** (calebporzio) - Comandos rápidos

**Configuración actual**:
```json
"phpunit.phpunit": "${workspaceFolder}/vendor/bin/phpunit",
"better-phpunit.phpunitBinary": "${workspaceFolder}/vendor/bin/phpunit"
```

**Cómo usar**:

**Opción 1: Better PHPUnit (Recomendado)**
- `Cmd+K` `Cmd+R` - Ejecutar test actual
- `Cmd+K` `Cmd+F` - Ejecutar todos los tests del archivo
- `Cmd+K` `Cmd+P` - Ejecutar el último test

**Opción 2: PHPUnit Test Explorer**
- Abre la vista "Testing" en la barra lateral
- Verás un árbol con todos tus tests
- Click derecho para ejecutar

**Opción 3: Tasks**
- `Cmd+Shift+P` > "Tasks: Run Task"
- Selecciona "Run PHPUnit Tests"

**Para verificar**:
```bash
composer test
```

---

### 6. Xdebug (⚠️ NO instalado)

**Status**: ⚠️ No detectado

**Para instalar Xdebug en macOS**:

```bash
# Instalar con Homebrew
brew install php@8.4-xdebug

# O compilar manualmente
pecl install xdebug
```

**Configuración de php.ini**:

Localiza tu php.ini:
```bash
php --ini
```

Agrega al final:
```ini
[xdebug]
zend_extension=xdebug.so
xdebug.mode=debug,coverage
xdebug.start_with_request=yes
xdebug.client_host=localhost
xdebug.client_port=9003
xdebug.idekey=VSCODE
```

**Para verificar instalación**:
```bash
php -m | grep xdebug
```

**Usar debugging**:
1. Coloca un breakpoint (click en el margen izquierdo)
2. Presiona `F5`
3. Selecciona "Listen for Xdebug"
4. Ejecuta tu script PHP

---

## 🧪 Verificación de Todas las Herramientas

Ejecuta este comando para verificar todo:

```bash
# Verificar que todas las herramientas funcionan
echo "=== Verificando herramientas PHP ==="
echo ""

echo "1. PHP Version:"
php -v
echo ""

echo "2. Composer:"
composer --version
echo ""

echo "3. PHPUnit:"
./vendor/bin/phpunit --version
echo ""

echo "4. PHPStan:"
./vendor/bin/phpstan --version
echo ""

echo "5. PHP CodeSniffer:"
./vendor/bin/phpcs --version
echo ""

echo "6. PHPCBF:"
./vendor/bin/phpcbf --version
echo ""

echo "7. Xdebug:"
php -m | grep xdebug || echo "❌ Xdebug NO instalado"
echo ""

echo "8. Ejecutando tests:"
composer test
```

---

## 🎯 Comandos Rápidos

### Desde VSCode

**Command Palette** (`Cmd+Shift+P`):
- `Tasks: Run Task` > Ver todas las tareas disponibles
- `PHPUnit: Run Test` > Ejecutar test actual
- `Format Document` > Formatear archivo actual

**Atajos de teclado**:
- `F12` - Go to Definition
- `Shift+F12` - Find All References
- `F5` - Start Debugging
- `Cmd+K Cmd+R` - Run PHPUnit test
- `Ctrl+Shift+B` - Run default test task

### Desde Terminal

```bash
# Tests
composer test                 # Todos los tests
composer test-coverage        # Con coverage

# Análisis
composer phpstan             # Análisis estático
composer cs-check            # Check estilo
composer cs-fix              # Fix estilo
composer quality             # Todo junto

# Composer
composer validate            # Validar composer.json
composer install             # Instalar deps
composer update              # Actualizar deps
```

---

## 🐛 Solución de Problemas

### Intelephense no autocompleta

**Solución 1**: Recargar ventana
```
Cmd+Shift+P > "Developer: Reload Window"
```

**Solución 2**: Reindexar
```
Cmd+Shift+P > "Intelephense: Index Workspace"
```

**Solución 3**: Verificar que vendor/ no esté excluido en settings

---

### PHPStan no muestra errores

**Verificar**:
1. Abrir Output panel: `View > Output`
2. Seleccionar "PHPStan" en el dropdown
3. Ver si hay errores

**Solución**: Ejecutar manualmente
```bash
./vendor/bin/phpstan analyse --no-progress
```

---

### PHP CodeSniffer no se ejecuta

**Verificar rutas en settings.json**:
```json
"phpSniffer.executablesFolder": "${workspaceFolder}/vendor/bin/"
```

**Ejecutar manualmente**:
```bash
./vendor/bin/phpcs --standard=.phpcs.xml src/
```

---

### Tests no se ejecutan

**Verificar**:
```bash
# ¿Existe phpunit?
ls -la vendor/bin/phpunit

# ¿Funciona?
./vendor/bin/phpunit --version

# ¿Configuración correcta?
cat phpunit.xml
```

---

## 📝 Snippets Personalizados

Ya tienes snippets personalizados instalados. Para usarlos:

1. Abre un archivo PHP
2. Escribe uno de estos prefijos:
   - `phpclass` - Clase PHP con namespace Enlace2
   - `phpservice` - Service class completa
   - `phptest` - Test method
   - `enlace2-shorten` - Acortar URL
   - `enlace2-qr` - Crear QR
3. Presiona `Tab` para expandir

**Ver todos los snippets**:
- `Cmd+Shift+P` > "Preferences: Configure User Snippets"
- Selecciona "snippets.code-snippets"

---

## 🎨 Personalización Adicional

### Themes Recomendados

Ya tienes instalado:
- Material Icon Theme
- GitHub Theme

**Otros populares**:
- One Dark Pro
- Dracula Official
- Night Owl

**Cambiar theme**:
`Cmd+K Cmd+T`

### Font Ligatures

Para mejor legibilidad de código:

1. Instalar font con ligatures: [Fira Code](https://github.com/tonsky/FiraCode)
2. Agregar a settings.json:
```json
"editor.fontFamily": "Fira Code, Menlo, Monaco, 'Courier New', monospace",
"editor.fontLigatures": true
```

---

## ✨ Tips Avanzados

### 1. Multi-cursor editing
- `Cmd+D` - Seleccionar siguiente ocurrencia
- `Cmd+Shift+L` - Seleccionar todas las ocurrencias
- `Alt+Click` - Agregar cursor

### 2. Git Lens
- Hover sobre cualquier línea para ver último commit
- `Cmd+Shift+P` > "GitLens: " para ver todas las funciones

### 3. Rest Client
Crea archivo `.rest` o `.http`:
```http
### Test Enlace2 API
POST https://enlace2.com/api/url/add
Authorization: Bearer YOUR_API_KEY
Content-Type: application/json

{
  "url": "https://google.com"
}
```

Click en "Send Request" para probar.

---

## 📚 Recursos Adicionales

- [Intelephense Docs](https://github.com/bmewburn/vscode-intelephense)
- [PHP Debug Guide](https://xdebug.org/docs/)
- [VSCode PHP Tips](https://code.visualstudio.com/docs/languages/php)
- [Laravel VSCode](https://laravelshift.com/laravel-code-tips)

---

**Última actualización**: 2025-10-09
**Estado**: ✅ Todas las extensiones configuradas correctamente (excepto Xdebug)
