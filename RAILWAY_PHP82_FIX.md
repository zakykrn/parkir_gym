# 🔧 Fix PHP 8.0 Error di Railway

## ❌ Error
```
error: php80 has been dropped due to the lack of maintenance
```

## ✅ Solusi yang Sudah Diterapkan

### 1. ✅ Update composer.json
- PHP requirement diubah dari `^8.0` menjadi `^8.2`

### 2. ✅ Buat nixpacks.toml
- Memaksa Nixpacks menggunakan PHP 8.2
- Syntax yang benar untuk Nixpacks

### 3. ✅ Buat Dockerfile (Alternatif)
- Jika Nixpacks masih error, Railway akan gunakan Dockerfile
- Menggunakan PHP 8.2 secara eksplisit

## 🚀 Langkah Selanjutnya

### Option A: Gunakan Nixpacks (Recommended)

1. **Commit perubahan:**
   ```bash
   git add .
   git commit -m "Fix PHP version to 8.2"
   git push
   ```

2. **Railway akan auto-detect:**
   - `nixpacks.toml` → PHP 8.2
   - `composer.json` → PHP ^8.2

3. **Redeploy** di Railway Dashboard

### Option B: Gunakan Dockerfile

Jika Nixpacks masih error:

1. Di Railway Dashboard → Settings
2. **Builder:** Pilih **Dockerfile**
3. **Dockerfile Path:** `Dockerfile`
4. Redeploy

## 📝 File yang Diperbaiki

✅ `composer.json` - PHP ^8.2
✅ `nixpacks.toml` - PHP 8.2 eksplisit
✅ `Dockerfile` - Backup jika Nixpacks gagal

## ✅ Setelah Deploy

1. Tunggu build selesai
2. Cek logs
3. Run migrations:
   ```
   php artisan migrate --force
   ```

