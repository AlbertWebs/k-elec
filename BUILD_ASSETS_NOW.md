# Build Assets for Production - Step by Step

## Your .env is CORRECT ✅
Your `APP_URL=https://k-elec.co.ke` is set correctly.

## The Problem
Vite is trying to load from dev server because `public/build/manifest.json` doesn't exist on your server, or it's in the wrong location (`public/build/.vite/manifest.json`).

## Solution: Build and Upload Assets

### Step 1: Build Assets Locally

On your **local machine** (where you have Node.js installed):

```bash
# Navigate to project directory
cd /path/to/k-elec

# Install dependencies (if not already done)
npm install

# Build for production
npm run build
```

This will create:
- `public/build/manifest.json`
- `public/build/assets/app-xxxxx.css`
- `public/build/assets/app-xxxxx.js`

### Step 2: Verify Build Output

Check that these files exist:
```bash
ls -la public/build/
ls -la public/build/assets/
```

You should see:
- `manifest.json`
- `assets/app-xxxxx.css`
- `assets/app-xxxxx.js`

### Step 3: Upload to Server

Upload the **entire** `public/build/` directory to your server:

**Using FTP/SFTP:**
- Upload `public/build/` folder
- Destination: `public/build/` on server (same path)

**Using SSH:**
```bash
# From local machine
scp -r public/build/ user@k-elec.co.ke:/path/to/project/public/
```

### Step 4: Set Permissions on Server

SSH into your server and run:
```bash
cd /path/to/your/project
chmod -R 755 public/build
chown -R www-data:www-data public/build  # Adjust user/group as needed
```

### Step 5: Clear Laravel Caches

On your server:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 6: Fix Manifest Location (If Needed)

If the manifest is in `public/build/.vite/manifest.json` instead of `public/build/manifest.json`:

**On your server:**
```bash
cd /path/to/your/project/public/build
# Copy manifest to correct location
cp .vite/manifest.json manifest.json
# Or move it
mv .vite/manifest.json manifest.json
```

### Step 7: Verify

1. Check `public/build/manifest.json` exists on server (NOT in `.vite/` subdirectory)
2. Visit your site - CSS should load
3. Check browser console (F12) - no 404 errors

## Alternative: Build on Server

If you have Node.js on your server:

```bash
# SSH into server
cd /path/to/your/project

# Install dependencies
npm install

# Build assets
npm run build

# Set permissions
chmod -R 755 public/build

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Expected Result

After building, your HTML should show:
```html
<link rel="stylesheet" href="/build/assets/app-xxxxx.css">
<script type="module" src="/build/assets/app-xxxxx.js"></script>
```

NOT:
```html
<script src="https://[::1]:5174/..."></script>
```

## Troubleshooting

### If build fails:
- Ensure Node.js version >= 16
- Run `npm install` first
- Check for errors in build output

### If assets still don't load:
- Verify `public/build/manifest.json` exists (NOT `public/build/.vite/manifest.json`)
- If manifest is in `.vite/` folder, copy it: `cp public/build/.vite/manifest.json public/build/manifest.json`
- Check file permissions: `ls -la public/build/`
- Verify web server can read the files
- Check browser console for specific errors
- Clear Laravel caches again: `php artisan config:clear && php artisan view:clear`
