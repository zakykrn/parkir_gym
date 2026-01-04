# 🚂 Final Setup Railway - Fix Healthcheck

## ✅ Yang Sudah Diperbaiki

1. ✅ **Route `/health`** - Ditambahkan untuk healthcheck
2. ✅ **railway.json** - Healthcheck path: `/health`, timeout: 300s
3. ✅ **railway.toml** - Healthcheck path: `/health`, timeout: 300s
4. ✅ **PHP Version** - Diupdate ke 8.2
5. ✅ **nixpacks.toml** - PHP 8.2 eksplisit

## 🚀 Langkah Deploy

### 1. Commit & Push
```bash
git add .
git commit -m "Fix Railway healthcheck and PHP version"
git push
```

### 2. Di Railway Dashboard → Settings

**Build Command:** (KOSONGKAN - biarkan Nixpacks handle)

**Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

**Healthcheck Path:**
```
/health
```

**Healthcheck Timeout:**
```
300
```

**Root Directory:** (KOSONGKAN)

### 3. Environment Variables

Pastikan sudah di-set:

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

Railway akan otomatis redeploy setelah push.

## ✅ Verifikasi

Setelah deploy berhasil:

1. **Test Healthcheck:**
   ```
   curl https://parkirgym-production.up.railway.app/health
   ```
   Harus return: `{"status":"ok"}`

2. **Test Homepage:**
   ```
   https://parkirgym-production.up.railway.app/
   ```

3. **Test Admin:**
   ```
   https://parkirgym-production.up.railway.app/admin/login
   ```

## 🔍 Troubleshooting

### Healthcheck Masih Failed

1. **Cek Logs** di Railway Dashboard
2. **Cek apakah server start:**
   - Logs harus ada: "Laravel development server started"
3. **Cek route:**
   - Test: `curl https://your-app.railway.app/health`
4. **Increase timeout** jika perlu (300 sudah cukup)

### 500 Error

1. **Cek APP_KEY** - Harus ada di Variables
2. **Cek Database** - Pastikan MySQL terhubung
3. **Cek Logs** - Lihat error detail

### 404 Error

1. **Cek Root Directory** - Harus kosong
2. **Cek Routes** - Pastikan route terdaftar
3. **Clear cache:**
   ```
   php artisan config:clear
   php artisan route:clear
   ```

## 📝 Checklist

- [ ] Route `/health` sudah ada
- [ ] PHP 8.2 di composer.json
- [ ] nixpacks.toml dengan PHP 82
- [ ] railway.json dengan healthcheck path
- [ ] Environment variables sudah di-set
- [ ] Build & Start commands sudah benar
- [ ] Root directory dikosongkan
- [ ] Commit & push sudah dilakukan
- [ ] Redeploy sudah dilakukan

## 🎉 Setelah Berhasil

1. Run migrations:
   ```
   php artisan migrate --force
   ```

2. Test aplikasi:
   - Home: `/`
   - Admin: `/admin/login`
   - API: `/api/kendaraan`

