# 🔧 Fix Healthcheck Failed di Railway

## ❌ Error
```
Healthcheck failed!
1/1 replicas never became healthy!
```

## ✅ Solusi yang Diterapkan

### 1. ✅ Route Healthcheck
- Ditambahkan route `/health` yang sederhana
- Tidak butuh database atau view
- Return JSON `{"status": "ok"}`

### 2. ✅ Update Railway Config
- `healthcheckPath` diubah ke `/health`
- `healthcheckTimeout` dinaikkan ke 300 detik
- Start command tetap sama

## 🚀 Langkah Selanjutnya

### 1. Commit & Push
```bash
git add .
git commit -m "Add healthcheck route and fix Railway config"
git push
```

### 2. Di Railway Dashboard

**Settings → Healthcheck Path:**
```
/health
```

**Settings → Healthcheck Timeout:**
```
300
```

**Settings → Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 3. Redeploy

Railway akan otomatis redeploy atau klik **Redeploy** manual.

## 🔍 Verifikasi

Setelah deploy, test healthcheck:
```
curl https://parkirgym-production.up.railway.app/health
```

Harus return: `{"status":"ok"}`

## 📝 File yang Diperbaiki

✅ `routes/web.php` - Route `/health` ditambahkan
✅ `railway.json` - Healthcheck path diupdate
✅ `railway.toml` - Healthcheck path diupdate

## ⚠️ Jika Masih Error

1. **Cek Logs** di Railway Dashboard
2. **Cek apakah server start:**
   - Logs harus menunjukkan: "Laravel development server started"
3. **Cek database connection:**
   - Pastikan MySQL service terhubung
   - Pastikan environment variables benar

## 🎯 Route Healthcheck

Route `/health` sekarang tersedia dan tidak memerlukan:
- ❌ Database connection
- ❌ View rendering
- ❌ Authentication
- ✅ Hanya return JSON sederhana

