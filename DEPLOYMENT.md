# Deployment Guide - CSS/Assets Not Loading

## Issue: CSS not loading on remote server

This happens because Vite assets need to be compiled for production. The `@vite()` directive in Blade templates requires built assets in the `public/build/` directory.

## Quick Fix - Build Assets

### Option 1: Using the deployment script (Recommended)

```bash
chmod +x deploy.sh
./deploy.sh
```

### Option 2: Manual steps

1. **Build assets locally:**
   ```bash
   npm install
   npm run build
   ```

2. **Upload to server:**
   - Upload the entire `public/build/` directory to your remote server
   - Ensure it's in the same location: `public/build/`

3. **Set environment variables on remote server:**
   ```env
   APP_URL=https://your-domain.com
   APP_ENV=production
   APP_DEBUG=false
   ```

4. **Clear caches on remote server:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   php artisan route:clear
   ```

## Complete Deployment Checklist

### Before Deployment

- [ ] Run `npm install` to ensure dependencies are installed
- [ ] Run `npm run build` to compile assets
- [ ] Verify `public/build/manifest.json` exists
- [ ] Check `public/build/assets/` contains CSS and JS files

### On Remote Server

- [ ] Upload `public/build/` directory
- [ ] Set `APP_URL` in `.env` to your production domain (with https://)
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Clear all Laravel caches
- [ ] Verify web server document root points to `public/` directory
- [ ] Check file permissions: `chmod -R 755 public/build`

### Web Server Configuration

#### Apache (.htaccess should be in public/)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx
```nginx
server {
    root /path/to/your/project/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

## Troubleshooting

### CSS/JS files return 404

1. **Check if build directory exists:**
   ```bash
   ls -la public/build/
   ```

2. **Verify manifest.json:**
   ```bash
   cat public/build/manifest.json
   ```

3. **Check APP_URL in .env:**
   ```bash
   grep APP_URL .env
   ```
   Should match your actual domain: `APP_URL=https://yourdomain.com`

4. **Check browser console:**
   - Open browser DevTools (F12)
   - Check Network tab for failed requests
   - Look for 404 errors on CSS/JS files

5. **Verify asset URLs:**
   - The `@vite()` helper should generate URLs like: `/build/assets/app-xxxxx.css`
   - If URLs are wrong, check `APP_URL` setting

### Assets load but styles don't apply

- Clear browser cache (Ctrl+Shift+R or Cmd+Shift+R)
- Check if Tailwind CSS is properly compiled
- Verify `resources/css/app.css` imports Tailwind directives

### Build fails

- Ensure Node.js and npm are installed
- Run `npm install` to install dependencies
- Check for errors in the build output
- Verify `vite.config.js` is correct

## Production Optimization

After successful deployment, optimize Laravel:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Rollback Plan

If assets don't load after deployment:

1. Check previous deployment's `public/build/` directory
2. Restore from backup if available
3. Rebuild assets: `npm run build`
4. Re-upload `public/build/` directory

## Notes

- The `@vite()` directive automatically handles asset versioning
- In development, Vite dev server serves assets
- In production, built assets in `public/build/` are served
- Never commit `public/build/` to git (should be in .gitignore)
- Always build assets before deploying to production
