# 🚂 Quick Setup Railway - Fix 404 Error

## ⚠️ Masalah: 404 Not Found di Railway

Railway tidak tahu ini adalah aplikasi Laravel. Ikuti langkah berikut:

## 🔧 Langkah Perbaikan

### 1. Set Root Directory di Railway

1. Buka Railway Dashboard
2. Klik pada **PHP Service** Anda
3. Klik **Settings** tab
4. Di bagian **Root Directory**, **KOSONGKAN** (biarkan default)
5. Klik **Save**

### 2. Set Environment Variables

Di Railway Dashboard → **Variables** tab, tambahkan:

```env
APP_NAME=Smart Parking
APP_ENV=production
APP_KEY=base64:yM70qtNSlX7nDRMcn3SfQ+86Xq4XXg8lIfqxTs6R03A=
APP_DEBUG=false
APP_URL=https://parkirgym-production.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SESSION_DRIVER=database
CACHE_DRIVER=database
```

**PENTING:** Ganti `APP_URL` dengan URL Railway Anda yang sebenarnya!

### 3. Set Build & Start Commands

Di Railway Dashboard → **Settings**:

**Build Command:**
```
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 4. Redeploy

1. Klik **Deployments** tab
2. Klik **Redeploy** pada deployment terbaru
3. Atau push ulang ke Git untuk trigger auto-deploy

### 5. Run Migrations (Setelah Deploy Berhasil)

Via Railway Dashboard → **Deployments** → **Run Command**:
```
php artisan migrate --force
```

## ✅ Checklist

- [ ] Root Directory dikosongkan
- [ ] Environment variables sudah di-set
- [ ] APP_KEY sudah ada
- [ ] APP_URL sudah benar
- [ ] Build command sudah di-set
- [ ] Start command sudah di-set
- [ ] Redeploy sudah dilakukan
- [ ] Migrations sudah dijalankan

## 🔍 Verifikasi

Setelah redeploy, cek:
1. **Build Logs** - Pastikan build berhasil
2. **Deploy Logs** - Pastikan server start
3. **Access URL** - Coba akses https://parkirgym-production.up.railway.app

## 🆘 Masih Error?

1. **Cek Logs** di Railway Dashboard
2. **Cek APP_URL** - harus sama dengan URL Railway
3. **Cek Database** - pastikan MySQL service terhubung
4. **Clear Cache:**
   ```
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

