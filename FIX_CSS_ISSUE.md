# URGENT FIX: CSS Not Loading on Production

## Problem Identified

Your HTML shows Vite is trying to load from dev server:
```html
<script type="module" src="https://[::1]:5174/@vite/client"></script>
```

This means:
1. **Assets are NOT built for production** - `public/build/` directory is missing or incomplete
2. **APP_URL is wrong** - URLs show `/public` in them (should be just the domain)
3. **Web server not configured** - Document root should point to `public/` directory

## IMMEDIATE FIX STEPS

### Step 1: Build Assets (CRITICAL)

**On your local machine or server with Node.js:**

```bash
cd /path/to/k-elec
npm install
npm run build
```

This creates `public/build/` with compiled CSS and JS.

### Step 2: Upload Built Assets

Upload the entire `public/build/` directory to your server:
- Source: `public/build/` (local)
- Destination: `public/build/` (server)

### Step 3: Fix .env on Server

On your remote server, edit `.env`:

```env
APP_URL=https://k-elec.co.ke
APP_ENV=production
APP_DEBUG=false
```

**IMPORTANT:** Remove `/public` from APP_URL - it should be just the domain!

### Step 4: Fix Web Server Configuration

Your web server MUST point to the `public/` directory, not the project root.

#### For Apache (cPanel/Shared Hosting)

Create/update `.htaccess` in project root:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### For Nginx

```nginx
server {
    root /path/to/k-elec/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### Step 5: Clear All Caches

On your server:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear
```

### Step 6: Verify

1. Check `public/build/manifest.json` exists
2. Check `public/build/assets/` has CSS and JS files
3. Visit site - CSS should load
4. Check browser console - no 404 errors

## Quick Test

After fixing, the HTML should show:
```html
<link rel="stylesheet" href="/build/assets/app-xxxxx.css">
<script type="module" src="/build/assets/app-xxxxx.js"></script>
```

NOT:
```html
<script src="https://[::1]:5174/..."></script>
```

## If Still Not Working

1. Check file permissions: `chmod -R 755 public/build`
2. Verify `APP_URL` in `.env` matches your domain exactly
3. Check web server error logs
4. Verify `public/build/manifest.json` is readable
