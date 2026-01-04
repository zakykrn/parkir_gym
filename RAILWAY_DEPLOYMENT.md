# 🚂 Panduan Deploy ke Railway

## ⚠️ Masalah 404 di Railway

Railway perlu dikonfigurasi dengan benar untuk Laravel. Berikut langkah-langkahnya:

## 📋 Konfigurasi Railway

### 1. File yang Sudah Dibuat

✅ `nixpacks.toml` - Konfigurasi build untuk Railway
✅ `railway.json` - Konfigurasi deployment
✅ `Procfile` - Start command
✅ `.railwayignore` - File yang diabaikan saat deploy

### 2. Setup di Railway Dashboard

#### A. Environment Variables

Tambahkan di Railway Dashboard → Variables:

```env
APP_NAME=Smart Parking
APP_ENV=production
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

**PENTING:** 
- Generate APP_KEY dengan: `php artisan key:generate --show`
- Copy hasilnya ke Railway Variables

#### B. Root Directory

Di Railway Dashboard → Settings:
- **Root Directory:** (kosongkan, biarkan default)
- Railway akan otomatis detect Laravel

#### C. Build & Deploy Settings

1. **Build Command:**
   ```
   composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
   ```

2. **Start Command:**
   ```
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

### 3. Setup Database

1. **Buat MySQL Service** di Railway
2. **Hubungkan** MySQL service ke PHP service
3. **Copy environment variables** dari MySQL ke PHP:
   - `MYSQLHOST` → `DB_HOST`
   - `MYSQLPORT` → `DB_PORT`
   - `MYSQLDATABASE` → `DB_DATABASE`
   - `MYSQLUSER` → `DB_USERNAME`
   - `MYSQLPASSWORD` → `DB_PASSWORD`

### 4. Run Migrations

Setelah deploy pertama, jalankan migrations:

**Option A: Via Railway CLI**
```bash
railway run php artisan migrate --force
```

**Option B: Via Railway Dashboard**
1. Buka service → Deployments
2. Klik "..." → Run Command
3. Masukkan: `php artisan migrate --force`

### 5. Setup Storage

Jalankan command untuk link storage:

```bash
railway run php artisan storage:link
```

## 🔧 Troubleshooting

### Error 404: Page Not Found

**Penyebab:**
- Root directory salah
- Public folder tidak dikenali
- Routes tidak ter-cache

**Solusi:**
1. Pastikan `public/index.php` ada
2. Pastikan build command berjalan
3. Clear cache: `php artisan config:clear && php artisan route:clear`

### Error 500: Server Error

**Penyebab:**
- APP_KEY tidak ada
- Database connection error
- Missing dependencies

**Solusi:**
1. Cek APP_KEY di Railway Variables
2. Cek database connection
3. Cek logs di Railway Dashboard → Logs

### Assets (CSS/JS) Tidak Load

**Penyebab:**
- Asset path salah
- Public folder tidak accessible

**Solusi:**
1. Pastikan CSS/JS ada di `public/css/`
2. Gunakan `asset()` helper di Blade
3. Cek APP_URL di .env

## 📝 Checklist Deployment

- [ ] Environment variables sudah di-set
- [ ] APP_KEY sudah di-generate dan di-set
- [ ] Database connection sudah benar
- [ ] Build command berhasil
- [ ] Migrations sudah dijalankan
- [ ] Storage link sudah dibuat (jika perlu)
- [ ] APP_URL sudah benar

## 🚀 Quick Deploy

1. **Push ke Git:**
   ```bash
   git add .
   git commit -m "Deploy to Railway"
   git push
   ```

2. **Connect Railway ke Git:**
   - Railway Dashboard → New Project
   - Connect GitHub/GitLab
   - Pilih repository

3. **Setup Variables:**
   - Copy dari `.env.example`
   - Generate APP_KEY
   - Set database variables

4. **Deploy:**
   - Railway akan auto-deploy
   - Tunggu build selesai
   - Cek logs jika error

## 📞 Support

Jika masih error, cek:
1. Railway Logs (Dashboard → Logs)
2. Build Logs (Dashboard → Deployments)
3. Laravel Logs (storage/logs/laravel.log)

