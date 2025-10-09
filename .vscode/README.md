# Configuración de VSCode para Enlace2 Package

Este directorio contiene la configuración optimizada de Visual Studio Code para el desarrollo del paquete Enlace2 Laravel.

## Archivos de Configuración

### 📦 extensions.json
Lista de extensiones recomendadas para instalar en VSCode. Al abrir el proyecto, VSCode te sugerirá instalarlas automáticamente.

**Categorías de extensiones:**
- **PHP Esenciales**: Intelephense, PHP Debug, PHP IntelliSense
- **Laravel**: Laravel Extra Intellisense, Blade, Snippets
- **Calidad de Código**: PHPStan, PHP Sniffer, PHPCBF
- **Testing**: PHPUnit
- **Utilidades**: GitLens, Todo Highlight, Better Comments

### ⚙️ settings.json
Configuración del workspace específica para este proyecto.

**Características principales:**
- Configuración de Intelephense para autocompletado avanzado
- PHPStan integrado con nivel 4
- PHP CodeSniffer ejecutándose al guardar
- Formateo automático de código
- Exclusión de carpetas vendor y cache
- Spell checker con palabras del proyecto
- Configuración específica por lenguaje (PHP, JSON, Markdown)

### 🚀 launch.json
Configuraciones para debugging y ejecución.

**Configuraciones disponibles:**
1. **Listen for Xdebug**: Para debugging con Xdebug
2. **Launch currently open script**: Ejecutar el archivo PHP actual
3. **Run PHPUnit Tests**: Ejecutar todos los tests con coverage
4. **Run Current PHPUnit Test**: Ejecutar solo el test actual
5. **Run Example - Basic Usage**: Ejecutar el ejemplo básico

**Uso:**
- Presiona `F5` para iniciar debugging
- Selecciona la configuración desde el panel de debugging

### 📋 tasks.json
Tareas automatizadas que puedes ejecutar desde VSCode.

**Tareas disponibles:**
- `Run PHPUnit Tests` - Ejecutar todos los tests (Ctrl+Shift+B)
- `Run PHPUnit with Coverage` - Tests con reporte de coverage
- `Run PHPStan Analysis` - Análisis estático de código
- `Check Code Style` - Verificar estilo de código
- `Fix Code Style` - Corregir estilo automáticamente
- `Run Quality Checks (All)` - Ejecutar todos los checks
- `Install Dependencies` - Instalar dependencias con Composer
- `Update Dependencies` - Actualizar dependencias
- `Validate Composer` - Validar composer.json
- `Run Example - Basic Usage` - Ejecutar ejemplo básico

**Uso:**
- Presiona `Cmd+Shift+P` (Mac) o `Ctrl+Shift+P` (Windows/Linux)
- Escribe "Tasks: Run Task"
- Selecciona la tarea deseada

### 📝 snippets.code-snippets
Snippets personalizados para acelerar el desarrollo.

**Snippets disponibles:**

| Prefijo | Descripción |
|---------|-------------|
| `phpclass` | Clase PHP con namespace de Enlace2 |
| `phpservice` | Clase de servicio completa |
| `phptest` | Método de test PHPUnit |
| `apirequest` | Método de request a la API |
| `trycatch-api` | Try-catch para excepciones de API |
| `phpvalidation` | Método de validación |
| `enlace2-shorten` | Acortar URL con Enlace2 |
| `enlace2-qr` | Crear código QR |
| `enlace2-campaign` | Crear campaña |
| `phpdoc` | DocBlock de método |

**Uso:**
- Escribe el prefijo en un archivo PHP
- Presiona `Tab` para expandir el snippet

## Atajos de Teclado Útiles

### General
- `Cmd+Shift+P` / `Ctrl+Shift+P` - Command Palette
- `Cmd+P` / `Ctrl+P` - Quick Open (buscar archivos)
- `Cmd+Shift+F` / `Ctrl+Shift+F` - Buscar en todos los archivos

### PHP Development
- `F12` - Go to Definition
- `Shift+F12` - Find All References
- `Cmd+.` / `Ctrl+.` - Quick Fix / Code Actions
- `F2` - Rename Symbol

### Testing
- `Ctrl+Shift+B` - Run default test task
- `F5` - Start Debugging

### Git
- `Ctrl+Shift+G` - Abrir panel de Git
- `Cmd+K Cmd+C` / `Ctrl+K Ctrl+C` - Comentar línea
- `Cmd+K Cmd+U` / `Ctrl+K Ctrl+U` - Descomentar línea

## Instalación Rápida

1. **Abrir el proyecto en VSCode**
   ```bash
   code .
   ```

2. **Instalar extensiones recomendadas**
   - VSCode mostrará una notificación para instalar las extensiones
   - O presiona `Cmd+Shift+P` y busca "Extensions: Show Recommended Extensions"

3. **Configurar Intelephense (opcional pero recomendado)**
   - Comprar licencia premium en: https://intelephense.com/
   - Activar con: `Cmd+Shift+P` > "Intelephense: Enter License Key"

4. **Configurar Xdebug (opcional, para debugging)**
   - Instalar Xdebug: https://xdebug.org/docs/install
   - Configurar en `php.ini`:
     ```ini
     zend_extension=xdebug.so
     xdebug.mode=debug
     xdebug.start_with_request=yes
     xdebug.client_port=9003
     ```

## Solución de Problemas

### Intelephense no autocompleta
1. Verificar que la extensión esté instalada y habilitada
2. Recargar VSCode: `Cmd+Shift+P` > "Developer: Reload Window"
3. Verificar que `vendor/` no esté excluido en settings

### PHPStan no se ejecuta
1. Verificar instalación: `composer show | grep phpstan`
2. Verificar ruta en settings.json: `"phpstan.configFile": "./phpstan.neon"`
3. Ejecutar manualmente: `composer phpstan`

### Tests no se ejecutan
1. Verificar PHPUnit instalado: `./vendor/bin/phpunit --version`
2. Verificar phpunit.xml existe
3. Ejecutar manualmente: `composer test`

## Personalización

Puedes sobrescribir cualquier configuración creando archivos en:
- `.vscode/settings.local.json` - Para settings personales (no commitear)
- `~/.vscode/settings.json` - Para settings globales de usuario

## Recursos Adicionales

- [VSCode PHP Documentation](https://code.visualstudio.com/docs/languages/php)
- [Intelephense Documentation](https://github.com/bmewburn/vscode-intelephense)
- [PHPUnit VSCode Extension](https://marketplace.visualstudio.com/items?itemName=emallin.phpunit)
- [Laravel VSCode Extensions](https://marketplace.visualstudio.com/search?term=laravel&target=VSCode)

---

**Nota**: Esta configuración está optimizada para macOS. Si usas Windows o Linux, algunos atajos pueden variar.
