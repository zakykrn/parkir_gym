# 🔧 Fix Build Error di Railway

## ❌ Error yang Terjadi
```
error: undefined variable 'composer'
```

## ✅ Solusi

### 1. Hapus nixpacks.toml (SUDAH DILAKUKAN)
File `nixpacks.toml` sudah dihapus karena syntax-nya salah. Nixpacks akan **auto-detect** Laravel dari:
- ✅ `composer.json` (ada)
- ✅ `artisan` file (ada)
- ✅ `app/` directory (ada)

### 2. Set di Railway Dashboard

**Settings → Build Command:**
```
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Settings → Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

**Settings → Root Directory:**
- **KOSONGKAN** (biarkan default)

### 3. Environment Variables

Pastikan sudah di-set di Railway Dashboard → Variables:

```env
APP_KEY=base64:yM70qtNSlX7nDRMcn3SfQ+86Xq4XXg8lIfqxTs6R03A=
APP_URL=https://parkirgym-production.up.railway.app
APP_ENV=production
APP_DEBUG=false

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}
```

### 4. Redeploy

1. **Commit perubahan:**
   ```bash
   git add .
   git commit -m "Fix Railway build config"
   git push
   ```

2. **Atau Redeploy manual** di Railway Dashboard

## 📝 Yang Sudah Diperbaiki

✅ `nixpacks.toml` - **DIHAPUS** (biarkan auto-detect)
✅ `railway.json` - Build command dihapus (set di Dashboard)
✅ `Procfile` - Start command tetap ada sebagai backup

## 🎯 Nixpacks Auto-Detect

Nixpacks akan otomatis:
- Detect PHP dari `composer.json`
- Install Composer
- Detect Laravel dari `artisan` file
- Run `composer install`

Anda hanya perlu set:
- **Build Command** (untuk cache)
- **Start Command** (untuk serve)

## ✅ Setelah Redeploy

1. Tunggu build selesai
2. Cek logs untuk memastikan tidak ada error
3. Jalankan migrations:
   ```
   php artisan migrate --force
   ```

