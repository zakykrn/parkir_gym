# 🔧 Disable Healthcheck di Railway (Sementara)

Jika healthcheck masih error, kita bisa disable sementara untuk debug.

## ⚠️ Option 1: Disable Healthcheck di Railway Dashboard

1. Railway Dashboard → PHP Service → Settings
2. Di bagian **Deploy**:
   - **Healthcheck Path:** KOSONGKAN atau hapus
   - Atau set ke: `/` (root)
3. Save dan redeploy

## ⚠️ Option 2: Update railway.json

```json
{
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

Hapus `healthcheckPath` dan `healthcheckTimeout`.

## 🔍 Debug: Cek Logs

1. Railway Dashboard → Logs Tab
2. Cari error messages
3. Common errors:
   - Database connection failed
   - APP_KEY missing
   - View not found
   - Route not found

## ✅ Test Manual

Setelah disable healthcheck, test manual:

1. **Test health route:**
   ```
   curl https://parkirgym-production.up.railway.app/health
   ```

2. **Test home:**
   ```
   curl https://parkirgym-production.up.railway.app/
   ```

3. **Cek response:**
   - Jika return HTML → OK
   - Jika return 500 → Cek logs
   - Jika return 404 → Cek routes

## 🎯 Root Cause

Healthcheck gagal biasanya karena:
1. ❌ Server tidak start
2. ❌ Route error (database connection)
3. ❌ View error
4. ❌ Config error

Setelah disable healthcheck, kita bisa lihat error sebenarnya di logs.

