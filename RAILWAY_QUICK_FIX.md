# ⚡ Quick Fix Railway Build Error

## Masalah
```
error: undefined variable 'composer'
```

## Solusi Cepat (2 Menit)

### 1. Di Railway Dashboard → Settings:

**Build Command:**
```
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

**Root Directory:** KOSONGKAN

### 2. Variables (jika belum ada):

```
APP_KEY=base64:yM70qtNSlX7nDRMcn3SfQ+86Xq4XXg8lIfqxTs6R03A=
APP_URL=https://parkirgym-production.up.railway.app
APP_ENV=production
APP_DEBUG=false
```

### 3. Redeploy

Klik **Redeploy** di Deployments tab.

## ✅ Selesai!

Nixpacks akan auto-detect Laravel dari `composer.json` dan `artisan` file.

