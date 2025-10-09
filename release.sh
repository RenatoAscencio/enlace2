#!/bin/bash

# Release Script for Enlace2 Laravel Package
# Usage: ./release.sh [version] [type]
# Example: ./release.sh 1.1.0 minor

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║   Enlace2 Package Release Script              ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════╝${NC}"
echo ""

# Check if version is provided
if [ -z "$1" ]; then
    echo -e "${RED}Error: Version number required${NC}"
    echo "Usage: ./release.sh [version] [type]"
    echo "Example: ./release.sh 1.1.0 minor"
    echo ""
    echo "Types: major | minor | patch"
    exit 1
fi

VERSION=$1
TYPE=${2:-minor}

echo -e "${BLUE}→${NC} Preparing release ${GREEN}v${VERSION}${NC} (${TYPE})"
echo ""

# Verify clean working directory
echo -e "${BLUE}→${NC} Checking git status..."
if ! git diff-index --quiet HEAD --; then
    echo -e "${YELLOW}⚠${NC}  Warning: You have uncommitted changes"
    echo -e "   Please commit or stash your changes first"
    exit 1
fi
echo -e "${GREEN}✓${NC} Working directory is clean"

# Verify we're on main branch
BRANCH=$(git rev-parse --abbrev-ref HEAD)
if [ "$BRANCH" != "main" ]; then
    echo -e "${YELLOW}⚠${NC}  Warning: You're on branch '${BRANCH}', not 'main'"
    read -p "Continue anyway? (y/N) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Pull latest changes
echo ""
echo -e "${BLUE}→${NC} Pulling latest changes..."
git pull origin $BRANCH
echo -e "${GREEN}✓${NC} Updated to latest"

# Run quality checks
echo ""
echo -e "${BLUE}→${NC} Running quality checks..."

echo -e "  ${BLUE}•${NC} Running tests..."
if ! composer test > /dev/null 2>&1; then
    echo -e "${RED}✗${NC} Tests failed"
    echo -e "   Run 'composer test' to see errors"
    exit 1
fi
echo -e "  ${GREEN}✓${NC} Tests passed"

echo -e "  ${BLUE}•${NC} Running PHPStan..."
if ! composer phpstan > /dev/null 2>&1; then
    echo -e "${YELLOW}⚠${NC}  PHPStan has warnings (continuing...)"
else
    echo -e "  ${GREEN}✓${NC} PHPStan passed"
fi

echo -e "  ${BLUE}•${NC} Checking code style..."
if ! composer cs-check > /dev/null 2>&1; then
    echo -e "${YELLOW}⚠${NC}  Code style issues found"
    read -p "  Auto-fix code style? (y/N) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        composer cs-fix
        echo -e "  ${GREEN}✓${NC} Code style fixed"
    fi
fi

echo -e "${GREEN}✓${NC} Quality checks completed"

# Update CHANGELOG
echo ""
echo -e "${BLUE}→${NC} Please update CHANGELOG.md with release notes"
echo -e "   Press Enter when ready to continue..."
read

# Check if CHANGELOG was updated
if ! grep -q "\[${VERSION}\]" CHANGELOG.md 2>/dev/null; then
    echo -e "${YELLOW}⚠${NC}  Warning: Version ${VERSION} not found in CHANGELOG.md"
    read -p "Continue anyway? (y/N) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Commit CHANGELOG
echo ""
echo -e "${BLUE}→${NC} Committing CHANGELOG..."
if git diff --quiet CHANGELOG.md; then
    echo -e "${YELLOW}⚠${NC}  CHANGELOG.md not modified"
else
    git add CHANGELOG.md
    git commit -m "chore: prepare release v${VERSION}"
    echo -e "${GREEN}✓${NC} CHANGELOG committed"
fi

# Create tag
echo ""
echo -e "${BLUE}→${NC} Creating git tag v${VERSION}..."

# Extract changelog for this version
TAG_MESSAGE="Release version ${VERSION}"
if grep -q "\[${VERSION}\]" CHANGELOG.md 2>/dev/null; then
    TAG_MESSAGE=$(sed -n "/\[${VERSION}\]/,/\[.*\]/p" CHANGELOG.md | head -n -1)
fi

git tag -a "v${VERSION}" -m "${TAG_MESSAGE}

🤖 Generated with Claude Code

Co-Authored-By: Claude <noreply@anthropic.com>
"
echo -e "${GREEN}✓${NC} Tag created"

# Push changes
echo ""
echo -e "${BLUE}→${NC} Pushing to GitHub..."
git push origin $BRANCH
git push origin "v${VERSION}"
echo -e "${GREEN}✓${NC} Pushed to GitHub"

# Create GitHub release (if gh CLI is available)
if command -v gh &> /dev/null; then
    echo ""
    echo -e "${BLUE}→${NC} Creating GitHub release..."

    RELEASE_NOTES="## What's Changed in v${VERSION}

See CHANGELOG.md for detailed changes.

**Full Changelog**: https://github.com/RenatoAscencio/enlace2/compare/v${VERSION%.*}.$((${VERSION##*.}-1))...v${VERSION}

🤖 Generated with [Claude Code](https://claude.com/claude-code)
"

    gh release create "v${VERSION}" \
        --title "v${VERSION}" \
        --notes "${RELEASE_NOTES}"

    echo -e "${GREEN}✓${NC} GitHub release created"
else
    echo ""
    echo -e "${YELLOW}⚠${NC}  'gh' CLI not found - skipping GitHub release"
    echo -e "   Create release manually at:"
    echo -e "   https://github.com/RenatoAscencio/enlace2/releases/new?tag=v${VERSION}"
fi

# Final message
echo ""
echo -e "${GREEN}╔════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║   ✓ Release v${VERSION} completed successfully!    ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${BLUE}Next steps:${NC}"
echo -e "  1. Verify release on GitHub:"
echo -e "     https://github.com/RenatoAscencio/enlace2/releases"
echo -e "  2. Wait ~10 minutes for Packagist to update"
echo -e "  3. Verify on Packagist:"
echo -e "     https://packagist.org/packages/enlace2/laravel-url-shortener"
echo -e "  4. Test installation:"
echo -e "     ${BLUE}composer require enlace2/laravel-url-shortener:^${VERSION}${NC}"
echo ""
echo -e "${GREEN}🎉 Great job!${NC}"
echo ""
