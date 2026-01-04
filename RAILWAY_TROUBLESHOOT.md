# 🔍 Troubleshooting Railway Healthcheck Error

## ❌ Masalah: Healthcheck Masih Failed

## 🔍 Step 1: Cek Logs di Railway

1. Railway Dashboard → PHP Service → **Logs Tab**
2. Scroll ke bagian error terakhir
3. Cari pesan error seperti:
   - "Database connection failed"
   - "No application encryption key"
   - "View not found"
   - "Route not found"

## 🔧 Step 2: Disable Healthcheck Sementara

### Di Railway Dashboard:
1. Settings → Deploy Section
2. **Healthcheck Path:** KOSONGKAN (hapus `/health`)
3. Save

Ini akan disable healthcheck sementara sehingga deployment bisa berjalan.

## ✅ Step 3: Test Manual Setelah Deploy

Setelah deploy berhasil (tanpa healthcheck), test:

1. **Test Health Route:**
   ```
   https://parkirgym-production.up.railway.app/health
   ```
   Harus return: `{"status":"ok"}`

2. **Test Home:**
   ```
   https://parkirgym-production.up.railway.app/
   ```
   Harus tampil halaman parkir

3. **Test Admin:**
   ```
   https://parkirgym-production.up.railway.app/admin/login
   ```
   Harus tampil halaman login

## 🐛 Common Issues & Fixes

### Issue 1: Database Connection Error
**Error di logs:**
```
SQLSTATE[HY000] [2002] Connection refused
```

**Fix:**
- Pastikan MySQL service terhubung
- Pastikan environment variables benar:
  - `DB_HOST=${MYSQLHOST}`
  - `DB_USERNAME=${MYSQLUSER}`
  - dll

### Issue 2: APP_KEY Missing
**Error di logs:**
```
No application encryption key has been specified
```

**Fix:**
- Pastikan `APP_KEY` ada di Railway Variables
- Value: `base64:yM70qtNSlX7nDRMcn3SfQ+86Xq4XXg8lIfqxTs6R03A=`

### Issue 3: View Not Found
**Error di logs:**
```
View [parkir.index] not found
```

**Fix:**
- Pastikan file `resources/views/parkir/index.blade.php` ada
- Clear view cache: `php artisan view:clear`

### Issue 4: Route Not Found
**Error:**
```
404 Not Found
```

**Fix:**
- Clear route cache: `php artisan route:clear`
- Cek `routes/web.php` ada route `/health`

## 🎯 Quick Fix: Disable Healthcheck

**File `railway.json` sudah diupdate** - healthcheck dihapus sementara.

**Commit & Push:**
```bash
git add railway.json
git commit -m "Disable healthcheck temporarily"
git push
```

Setelah deploy berhasil, kita bisa enable healthcheck lagi.

## 📝 Checklist Debug

- [ ] Cek Railway Logs untuk error detail
- [ ] Disable healthcheck sementara
- [ ] Test route `/health` manual
- [ ] Test route `/` manual
- [ ] Cek environment variables
- [ ] Cek database connection
- [ ] Cek APP_KEY

## 🚀 Setelah Fix

1. Enable healthcheck lagi di Dashboard
2. Set path: `/health`
3. Set timeout: `300`
4. Redeploy

