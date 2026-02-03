#!/bin/bash

echo "=========================================="
echo "Vite Production Check Script"
echo "=========================================="
echo ""

echo "1. Checking APP_ENV in .env file..."
if grep -q "APP_ENV=production" .env; then
    echo "   ✅ APP_ENV=production (CORRECT)"
else
    echo "   ❌ APP_ENV is NOT set to production"
    echo "   Current value:"
    grep APP_ENV .env
    echo ""
    echo "   ⚠️  FIX: Edit .env and change APP_ENV to 'production'"
fi

echo ""
echo "2. Checking manifest.json location..."
if [ -f "public/build/manifest.json" ]; then
    echo "   ✅ manifest.json exists at: public/build/manifest.json"
    ls -lh public/build/manifest.json
elif [ -f "public/build/.vite/manifest.json" ]; then
    echo "   ⚠️  manifest.json is in WRONG location: public/build/.vite/manifest.json"
    echo "   FIX: Run: cp public/build/.vite/manifest.json public/build/manifest.json"
else
    echo "   ❌ manifest.json NOT FOUND"
    echo "   FIX: Upload public/build/ directory from local machine"
fi

echo ""
echo "3. Checking if Laravel can read manifest.json..."
php artisan tinker --execute="
if (file_exists(public_path('build/manifest.json'))) {
    echo '   ✅ Laravel can read manifest.json';
} else {
    echo '   ❌ Laravel CANNOT read manifest.json';
}
"

echo ""
echo "4. Checking current APP_ENV in Laravel config..."
CURRENT_ENV=$(php artisan tinker --execute="echo config('app.env');")
echo "   Current config('app.env'): $CURRENT_ENV"
if [ "$CURRENT_ENV" = "production" ]; then
    echo "   ✅ Config shows production (CORRECT)"
else
    echo "   ❌ Config shows: $CURRENT_ENV (WRONG)"
    echo "   FIX: Run: php artisan config:clear"
fi

echo ""
echo "=========================================="
echo "Summary:"
echo "=========================================="
echo "If any checks failed, fix them and run:"
echo "  php artisan config:clear"
echo "  php artisan view:clear"
echo "  php artisan cache:clear"
echo ""
