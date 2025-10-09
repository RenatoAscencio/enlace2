# Extensiones Recomendadas de VSCode para Enlace2

Esta es la guía completa de extensiones de Visual Studio Code recomendadas para trabajar eficientemente con el proyecto Enlace2 Laravel Package.

## 🚀 Instalación Rápida

### Opción 1: Automática (Recomendada)
1. Abre el proyecto en VSCode
2. VSCode detectará automáticamente el archivo `.vscode/extensions.json`
3. Aparecerá una notificación: "Do you want to install the recommended extensions?"
4. Haz clic en "Install All"

### Opción 2: Manual
```bash
# Instalar todas las extensiones desde la terminal
code --install-extension bmewburn.vscode-intelephense-client
code --install-extension xdebug.php-debug
code --install-extension emallin.phpunit
# ... (ver lista completa abajo)
```

### Opción 3: Command Palette
1. Presiona `Cmd+Shift+P` (Mac) o `Ctrl+Shift+P` (Windows/Linux)
2. Busca: "Extensions: Show Recommended Extensions"
3. Instala las extensiones una por una

---

## 📦 Extensiones por Categoría

### 🐘 PHP Esenciales

#### **Intelephense** (⭐ IMPRESCINDIBLE)
- **ID**: `bmewburn.vscode-intelephense-client`
- **Descripción**: IntelliSense avanzado para PHP
- **Features**:
  - Autocompletado inteligente
  - Go to definition
  - Find all references
  - Documentación al hover
  - Refactoring (renombrar símbolos)
  - Análisis de código en tiempo real
- **Costo**: Gratis (Premium opcional $15 - altamente recomendado)
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)

#### **PHP Debug**
- **ID**: `xdebug.php-debug`
- **Descripción**: Debugging de PHP con Xdebug
- **Features**:
  - Breakpoints
  - Step debugging
  - Variable inspection
  - Stack traces
- **Requiere**: Xdebug instalado en tu sistema
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug)

#### **PHP Intellisense**
- **ID**: `zobo.php-intellisense`
- **Descripción**: IntelliSense adicional basado en PHP Language Server
- **Features**:
  - Completado de código
  - Signature help
  - Go to definition
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=zobo.php-intellisense)

---

### 🔴 Laravel Específico

#### **Laravel Extra Intellisense**
- **ID**: `amirrizki.laravel-extra-intellisense`
- **Descripción**: Autocompletado para Laravel
- **Features**:
  - Autocompletado de rutas
  - Autocompletado de vistas
  - Autocompletado de configuración
  - Autocompletado de traducciones
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=amirrizki.laravel-extra-intellisense)

#### **Laravel Blade Snippets**
- **ID**: `onecentlin.laravel-blade`
- **Descripción**: Sintaxis highlighting para Blade templates
- **Features**:
  - Syntax highlighting
  - Snippets para directivas Blade
  - Autocompletado
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade)

#### **Laravel 5 Snippets**
- **ID**: `onecentlin.laravel5-snippets`
- **Descripción**: Snippets para Laravel
- **Features**:
  - Snippets de facades
  - Snippets de métodos comunes
  - Artisan commands snippets
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel5-snippets)

#### **Laravel goto view**
- **ID**: `codingyu.laravel-goto-view`
- **Descripción**: Navegación rápida a vistas
- **Features**:
  - Ctrl+click en nombres de vistas
  - Ir directamente al archivo de vista
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view)

---

### ✅ Calidad de Código PHP

#### **PHP Sniffer**
- **ID**: `wongjn.php-sniffer`
- **Descripción**: PHP CodeSniffer integration
- **Features**:
  - Validación de estilo de código
  - Ejecuta al guardar
  - Muestra errores en tiempo real
- **Requiere**: PHP_CodeSniffer instalado vía Composer
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer)

#### **PHPStan**
- **ID**: `sanderronde.phpstan-vscode`
- **Descripción**: Análisis estático con PHPStan
- **Features**:
  - Análisis de tipos
  - Detección de errores
  - Integración con barra de estado
- **Requiere**: PHPStan instalado vía Composer
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=sanderronde.phpstan-vscode)

#### **PHP CS Fixer**
- **ID**: `persoderlind.vscode-phpcbf`
- **Descripción**: Auto-fix de estilo de código
- **Features**:
  - Formateo automático
  - Corrección de estilo
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=persoderlind.vscode-phpcbf)

---

### 🧪 Testing

#### **PHPUnit**
- **ID**: `emallin.phpunit`
- **Descripción**: Ejecutar tests de PHPUnit desde VSCode
- **Features**:
  - Ejecutar tests desde el editor
  - Ver resultados en panel
  - Ejecutar test individual
  - Ejecutar suite completa
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=emallin.phpunit)

#### **PHPUnit Test Explorer**
- **ID**: `recca0120.vscode-phpunit`
- **Descripción**: Test explorer UI para PHPUnit
- **Features**:
  - Vista de árbol de tests
  - Ejecutar tests con un click
  - Ver resultados visuales
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=recca0120.vscode-phpunit)

---

### 📦 Composer

#### **Composer**
- **ID**: `ikappas.composer`
- **Descripción**: Comandos de Composer
- **Features**:
  - Ejecutar comandos Composer
  - Autocompletado en composer.json
  - Validación
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=ikappas.composer)

#### **Composer PHP**
- **ID**: `devsense.composer-php-vscode`
- **Descripción**: Soporte avanzado para Composer
- **Features**:
  - IntelliSense en composer.json
  - Validación de versiones
  - Comandos integrados
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=devsense.composer-php-vscode)

---

### 🔀 Git

#### **GitLens** (⭐ IMPRESCINDIBLE)
- **ID**: `eamodio.gitlens`
- **Descripción**: Superpoderes de Git en VSCode
- **Features**:
  - Blame annotations inline
  - Ver historial de commits
  - Comparar cambios
  - Graph de commits
  - Buscar en historial
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens)

#### **Git History**
- **ID**: `donjayamanne.githistory`
- **Descripción**: Ver historial de Git
- **Features**:
  - Ver log de archivo
  - Comparar commits
  - Ver branches
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=donjayamanne.githistory)

#### **Git Graph**
- **ID**: `mhutchie.git-graph`
- **Descripción**: Visualización gráfica de Git
- **Features**:
  - Graph visual de commits
  - Ver ramas
  - Merge visual
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=mhutchie.git-graph)

---

### 🎨 Formateo y Estilo

#### **EditorConfig**
- **ID**: `editorconfig.editorconfig`
- **Descripción**: Soporte para EditorConfig
- **Features**:
  - Aplica reglas de .editorconfig
  - Consistencia entre editores
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)

#### **Prettier**
- **ID**: `esbenp.prettier-vscode`
- **Descripción**: Formateo de código para JSON, YAML, etc.
- **Features**:
  - Format on save
  - Consistencia de estilo
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)

---

### 🛠️ Utilidades Generales

#### **Code Spell Checker**
- **ID**: `streetsidesoftware.code-spell-checker`
- **Descripción**: Corrector ortográfico
- **Features**:
  - Detecta errores ortográficos
  - Sugerencias
  - Diccionarios personalizados
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=streetsidesoftware.code-spell-checker)

#### **TODO Highlight**
- **ID**: `wayou.vscode-todo-highlight`
- **Descripción**: Resalta TODOs y FIXMEs
- **Features**:
  - Highlighting de TODOs
  - Lista de todos los TODOs
  - Personalizable
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=wayou.vscode-todo-highlight)

#### **Better Comments**
- **ID**: `aaron-bond.better-comments`
- **Descripción**: Comentarios más legibles
- **Features**:
  - Colores para diferentes tipos de comentarios
  - ! para alertas
  - ? para preguntas
  - TODO para tareas
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments)

#### **Todo Tree**
- **ID**: `gruntfuggly.todo-tree`
- **Descripción**: Vista de árbol de TODOs
- **Features**:
  - Sidebar con todos los TODOs
  - Navegación rápida
  - Filtros
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=Gruntfuggly.todo-tree)

---

### 📝 Markdown

#### **Markdown All in One**
- **ID**: `yzhang.markdown-all-in-one`
- **Descripción**: Todo lo necesario para Markdown
- **Features**:
  - Shortcuts
  - Preview
  - TOC automático
  - Formateo
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=yzhang.markdown-all-in-one)

#### **markdownlint**
- **ID**: `davidanson.vscode-markdownlint`
- **Descripción**: Linter para Markdown
- **Features**:
  - Validación de sintaxis
  - Sugerencias de estilo
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=DavidAnson.vscode-markdownlint)

---

### 🎯 IntelliSense Adicional

#### **Path Intellisense**
- **ID**: `christian-kohler.path-intellisense`
- **Descripción**: Autocompletado de rutas de archivos
- **Features**:
  - Autocompletado de paths
  - Soporte para imports
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=christian-kohler.path-intellisense)

#### **IntelliCode**
- **ID**: `visualstudioexptteam.vscodeintellicode`
- **Descripción**: AI-assisted IntelliSense
- **Features**:
  - Sugerencias basadas en IA
  - Predicción de código
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=VisualStudioExptTeam.vscodeintellicode)

---

### 🐳 Docker (Opcional)

#### **Docker**
- **ID**: `ms-azuretools.vscode-docker`
- **Descripción**: Soporte para Docker
- **Features**:
  - Gestión de contenedores
  - Dockerfile syntax
  - Docker Compose support
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker)

---

### 🌐 REST Client (Opcional)

#### **REST Client**
- **ID**: `humao.rest-client`
- **Descripción**: Probar APIs HTTP desde VSCode
- **Features**:
  - Enviar requests HTTP
  - Ver responses
  - Variables de entorno
  - Ideal para probar la API de Enlace2
- **Link**: [Marketplace](https://marketplace.visualstudio.com/items?itemName=humao.rest-client)

---

## 🚫 Extensiones NO Recomendadas

Estas extensiones están en conflicto con las recomendadas o están deprecadas:

- `felixfbecker.php-intellisense` - Usar Intelephense en su lugar
- `felixfbecker.php-debug` - Usar `xdebug.php-debug` en su lugar

---

## 💡 Tips de Uso

### Intelephense Premium
Vale la pena los $15. Features premium:
- Rename refactoring
- Find all implementations
- Code folding
- Soporte premium

### Configurar Xdebug
Para usar PHP Debug, necesitas Xdebug:

```ini
; php.ini
zend_extension=xdebug.so
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.client_port=9003
```

### Atajos Útiles
- `Cmd+Shift+P` - Command Palette
- `Cmd+P` - Quick Open
- `F12` - Go to Definition
- `Shift+F12` - Find References
- `Cmd+.` - Quick Fix

---

## 🔄 Mantener Actualizadas

VSCode actualiza las extensiones automáticamente. Para forzar actualización:

1. `Cmd+Shift+P`
2. "Extensions: Check for Extension Updates"
3. Actualizar todas

---

## 📊 Extensiones por Prioridad

### 🔴 Críticas (Instalar primero)
1. Intelephense
2. GitLens
3. PHPUnit
4. PHP Debug

### 🟡 Importantes
1. Laravel Extra Intellisense
2. PHPStan
3. PHP Sniffer
4. EditorConfig

### 🟢 Nice to Have
1. Better Comments
2. Todo Tree
3. REST Client
4. Docker

---

**Última actualización**: 2025-10-09
**Proyecto**: Enlace2 Laravel Package
