#!/bin/bash

# Deployment script for K-Elec
# This script builds assets and prepares the application for production

echo "🚀 Starting deployment process..."

# Install/Update dependencies
echo "📦 Installing dependencies..."
npm install

# Build assets for production
echo "🔨 Building assets for production..."
npm run build

# Clear Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment complete!"
echo ""
echo "📋 Next steps:"
echo "1. Ensure APP_URL is set correctly in .env"
echo "2. Upload public/build/ directory to server"
echo "3. Verify web server points to public/ directory"
echo "4. Check file permissions on public/build/"
