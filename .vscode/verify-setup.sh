#!/bin/bash

# Script de Verificación de Configuración VSCode
# Enlace2 Laravel Package

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║   Verificación de Configuración VSCode - Enlace2 Package      ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Counters
PASSED=0
FAILED=0
WARNINGS=0

# Function to check command
check_command() {
    local cmd=$1
    local name=$2
    local required=$3

    if command -v $cmd &> /dev/null; then
        echo -e "${GREEN}✓${NC} $name encontrado"
        ((PASSED++))
        if [ ! -z "$4" ]; then
            echo -e "  ${BLUE}→${NC} $($cmd $4 2>&1 | head -1)"
        fi
        return 0
    else
        if [ "$required" = "true" ]; then
            echo -e "${RED}✗${NC} $name NO encontrado (REQUERIDO)"
            ((FAILED++))
        else
            echo -e "${YELLOW}⚠${NC} $name NO encontrado (opcional)"
            ((WARNINGS++))
        fi
        return 1
    fi
}

# Function to check file
check_file() {
    local file=$1
    local name=$2
    local required=$3

    if [ -f "$file" ]; then
        echo -e "${GREEN}✓${NC} $name existe"
        ((PASSED++))
        return 0
    else
        if [ "$required" = "true" ]; then
            echo -e "${RED}✗${NC} $name NO existe (REQUERIDO)"
            ((FAILED++))
        else
            echo -e "${YELLOW}⚠${NC} $name NO existe (opcional)"
            ((WARNINGS++))
        fi
        return 1
    fi
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "1. Verificando Sistema Base"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
check_command "php" "PHP" "true" "--version"
check_command "composer" "Composer" "true" "--version"
check_command "code" "VSCode CLI" "true" "--version"
check_command "git" "Git" "true" "--version"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "2. Verificando Herramientas PHP del Proyecto"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
check_file "./vendor/bin/phpunit" "PHPUnit" "true"
if [ -f "./vendor/bin/phpunit" ]; then
    echo -e "  ${BLUE}→${NC} $(./vendor/bin/phpunit --version)"
fi

check_file "./vendor/bin/phpstan" "PHPStan" "true"
if [ -f "./vendor/bin/phpstan" ]; then
    echo -e "  ${BLUE}→${NC} $(./vendor/bin/phpstan --version)"
fi

check_file "./vendor/bin/phpcs" "PHP CodeSniffer" "true"
if [ -f "./vendor/bin/phpcs" ]; then
    echo -e "  ${BLUE}→${NC} $(./vendor/bin/phpcs --version)"
fi

check_file "./vendor/bin/phpcbf" "PHPCBF" "true"
if [ -f "./vendor/bin/phpcbf" ]; then
    echo -e "  ${BLUE}→${NC} $(./vendor/bin/phpcbf --version)"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "3. Verificando Archivos de Configuración"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
check_file "./.vscode/settings.json" "VSCode Settings" "true"
check_file "./.vscode/extensions.json" "VSCode Extensions" "true"
check_file "./.vscode/launch.json" "VSCode Launch Config" "true"
check_file "./.vscode/tasks.json" "VSCode Tasks" "true"
check_file "./.vscode/snippets.code-snippets" "VSCode Snippets" "false"
check_file "./phpunit.xml" "PHPUnit Config" "true"
check_file "./phpstan.neon" "PHPStan Config" "true"
check_file "./.phpcs.xml" "PHPCS Config" "true"
check_file "./.editorconfig" "EditorConfig" "true"
check_file "./composer.json" "Composer JSON" "true"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "4. Verificando Extensiones VSCode (críticas)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

EXTENSIONS=(
    "bmewburn.vscode-intelephense-client:Intelephense:true"
    "xdebug.php-debug:PHP Debug:false"
    "eamodio.gitlens:GitLens:true"
    "wongjn.php-sniffer:PHP Sniffer:true"
    "recca0120.vscode-phpunit:PHPUnit:true"
    "calebporzio.better-phpunit:Better PHPUnit:false"
)

for ext in "${EXTENSIONS[@]}"; do
    IFS=':' read -r ext_id ext_name required <<< "$ext"

    if code --list-extensions | grep -q "^$ext_id$"; then
        echo -e "${GREEN}✓${NC} $ext_name instalado"
        ((PASSED++))
    else
        if [ "$required" = "true" ]; then
            echo -e "${RED}✗${NC} $ext_name NO instalado (REQUERIDO)"
            ((FAILED++))
        else
            echo -e "${YELLOW}⚠${NC} $ext_name NO instalado (opcional)"
            ((WARNINGS++))
        fi
    fi
done

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "5. Verificando Xdebug"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
if php -m | grep -q xdebug; then
    echo -e "${GREEN}✓${NC} Xdebug instalado"
    ((PASSED++))
    XDEBUG_VERSION=$(php -r "echo phpversion('xdebug');")
    echo -e "  ${BLUE}→${NC} Version: $XDEBUG_VERSION"

    # Check xdebug mode
    XDEBUG_MODE=$(php -r "echo ini_get('xdebug.mode');")
    if [ ! -z "$XDEBUG_MODE" ]; then
        echo -e "  ${BLUE}→${NC} Mode: $XDEBUG_MODE"
    fi
else
    echo -e "${YELLOW}⚠${NC} Xdebug NO instalado (opcional pero recomendado)"
    echo -e "  ${BLUE}→${NC} Para instalar: brew install php@8.4-xdebug"
    ((WARNINGS++))
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "6. Ejecutando Tests Rápidos"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Test Composer validate
echo -n "Validando composer.json... "
if composer validate --no-check-all --quiet 2>&1; then
    echo -e "${GREEN}✓${NC}"
    ((PASSED++))
else
    echo -e "${RED}✗${NC}"
    ((FAILED++))
fi

# Test PHPUnit (quick)
echo -n "Ejecutando PHPUnit (rápido)... "
if ./vendor/bin/phpunit --testsuite Unit --stop-on-failure --no-coverage > /dev/null 2>&1; then
    echo -e "${GREEN}✓${NC}"
    ((PASSED++))
else
    echo -e "${RED}✗${NC} (algunos tests fallaron)"
    ((FAILED++))
fi

# Test PHPStan (quick)
echo -n "Ejecutando PHPStan... "
if ./vendor/bin/phpstan analyse --no-progress --error-format=raw > /dev/null 2>&1; then
    echo -e "${GREEN}✓${NC}"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} (hay errores de análisis)"
    ((WARNINGS++))
fi

# Test PHPCS (quick)
echo -n "Verificando estilo de código... "
if ./vendor/bin/phpcs --standard=.phpcs.xml src/ --report=summary > /dev/null 2>&1; then
    echo -e "${GREEN}✓${NC}"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} (hay errores de estilo)"
    ((WARNINGS++))
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "RESUMEN"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo -e "${GREEN}✓ Exitosos:${NC} $PASSED"
echo -e "${RED}✗ Fallidos:${NC} $FAILED"
echo -e "${YELLOW}⚠ Advertencias:${NC} $WARNINGS"
echo ""

# Final verdict
if [ $FAILED -eq 0 ]; then
    if [ $WARNINGS -eq 0 ]; then
        echo -e "${GREEN}╔════════════════════════════════════════════════╗${NC}"
        echo -e "${GREEN}║  ✓ CONFIGURACIÓN PERFECTA - TODO FUNCIONANDO  ║${NC}"
        echo -e "${GREEN}╚════════════════════════════════════════════════╝${NC}"
        exit 0
    else
        echo -e "${YELLOW}╔════════════════════════════════════════════════╗${NC}"
        echo -e "${YELLOW}║  ⚠ CONFIGURACIÓN BUENA - HAY ADVERTENCIAS      ║${NC}"
        echo -e "${YELLOW}╚════════════════════════════════════════════════╝${NC}"
        echo ""
        echo "Revisa las advertencias arriba. El proyecto funcionará,"
        echo "pero algunas características opcionales no están disponibles."
        exit 0
    fi
else
    echo -e "${RED}╔════════════════════════════════════════════════╗${NC}"
    echo -e "${RED}║  ✗ HAY PROBLEMAS - REVISAR CONFIGURACIÓN      ║${NC}"
    echo -e "${RED}╚════════════════════════════════════════════════╝${NC}"
    echo ""
    echo "Por favor, revisa los errores marcados con ✗ arriba."
    echo "Consulta .vscode/SETUP_GUIDE.md para más información."
    exit 1
fi
