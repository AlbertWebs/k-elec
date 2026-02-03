# URGENT: Fix CSS Loading on Live Server

## Current Problem

Your HTML shows:
```html
<script type="module" src="https://[::1]:5174/@vite/client"></script>
```

This means `public/build/manifest.json` is **NOT on your server** or Laravel can't find it.

## IMMEDIATE FIX - 3 Steps

### Step 1: Upload Built Assets to Server

**You already built assets locally** - now upload them:

1. **From your local machine**, upload the entire `public/build/` folder to your server
2. **Destination on server**: `public/build/` (same path)
3. **Must include**: 
   - `manifest.json` (in `public/build/` root, NOT in subdirectory)
   - `assets/app-vxrG4Adk.css`
   - `assets/app-C1vo8EPt.js`

### Step 2: Clear View Cache on Server

**SSH into your server** and run:

```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

**CRITICAL**: The view cache is likely serving old HTML. Clear it!

### Step 3: Fix Web Server Configuration

Your URLs show `/public` in them (e.g., `https://k-elec.co.ke/public`). This means your web server document root is wrong.

**For Apache/cPanel:**

Your document root should point to: `/path/to/project/public`

**Check in cPanel:**
1. Go to "Domains" or "Subdomains"
2. Find `k-elec.co.ke`
3. Document Root should be: `public_html/public` (or wherever your `public/` folder is)
4. If it's pointing to project root, change it to point to `public/` folder

**OR create `.htaccess` in project root** (if you can't change document root):

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Verify After Fix

1. **Check manifest exists on server:**
   ```bash
   ls -la public/build/manifest.json
   ```

2. **Check file permissions:**
   ```bash
   chmod -R 755 public/build
   ```

3. **Visit site** - HTML should show:
   ```html
   <link rel="stylesheet" href="/build/assets/app-vxrG4Adk.css">
   ```
   NOT: `https://[::1]:5174/...`

## If Still Not Working

1. **Verify manifest.json location:**
   - Should be: `public/build/manifest.json`
   - NOT: `public/build/.vite/manifest.json`

2. **Check Laravel can read it:**
   ```bash
   php artisan tinker
   >>> file_exists(public_path('build/manifest.json'))
   ```
   Should return `true`

3. **Check APP_ENV:**
   ```bash
   grep APP_ENV .env
   ```
   Should be: `APP_ENV=production`
