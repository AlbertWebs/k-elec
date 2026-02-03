# CRITICAL: Check These 3 Things on Your Server

Laravel is still trying to use the dev server (`https://[::1]:5174`). This means one of these is wrong:

## 1. Check APP_ENV (MOST LIKELY ISSUE)

**SSH into your server and run:**
```bash
grep APP_ENV .env
```

**Must show:**
```
APP_ENV=production
```

**If it shows `APP_ENV=local` or anything else, fix it:**
```bash
# Edit .env file
nano .env
# Change APP_ENV to: production
# Save and exit (Ctrl+X, then Y, then Enter)
```

## 2. Verify manifest.json Location

**On your server, run:**
```bash
# Check if manifest exists
ls -la public/build/manifest.json

# If it doesn't exist, check if it's in wrong location
ls -la public/build/.vite/manifest.json

# If it's in .vite folder, move it:
cp public/build/.vite/manifest.json public/build/manifest.json
```

**The manifest MUST be at:** `public/build/manifest.json` (NOT in `.vite/` subfolder)

## 3. Test if Laravel Can Read It

**On your server, run:**
```bash
php artisan tinker
```

Then in tinker, type:
```php
file_exists(public_path('build/manifest.json'))
```

**Must return:** `true`

If it returns `false`, the file doesn't exist or Laravel can't read it.

## 4. Clear ALL Caches (CRITICAL)

**After fixing APP_ENV, run:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear
```

## 5. Verify APP_ENV is Loaded

**After clearing cache, verify:**
```bash
php artisan tinker
```

Then:
```php
config('app.env')
```

**Must return:** `"production"`

## Quick Fix Script

Run this on your server to check everything:

```bash
#!/bin/bash
echo "=== Checking APP_ENV ==="
grep APP_ENV .env

echo ""
echo "=== Checking manifest.json ==="
if [ -f "public/build/manifest.json" ]; then
    echo "✅ manifest.json exists at public/build/manifest.json"
    ls -lh public/build/manifest.json
else
    echo "❌ manifest.json NOT FOUND at public/build/manifest.json"
    if [ -f "public/build/.vite/manifest.json" ]; then
        echo "⚠️  Found at public/build/.vite/manifest.json - need to move it!"
    fi
fi

echo ""
echo "=== Checking Laravel can read it ==="
php artisan tinker --execute="echo file_exists(public_path('build/manifest.json')) ? '✅ Laravel can read manifest.json' : '❌ Laravel CANNOT read manifest.json';"

echo ""
echo "=== Current APP_ENV in config ==="
php artisan tinker --execute="echo config('app.env');"
```

Save this as `check-vite.sh`, make it executable (`chmod +x check-vite.sh`), and run it (`./check-vite.sh`).

## Most Common Issue

**99% of the time, the problem is:**
- `APP_ENV=local` instead of `APP_ENV=production` in `.env`

**Fix it, clear config cache, and it will work!**
