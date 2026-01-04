# 📍 Cara Set Healthcheck di Railway Dashboard

## 🎯 Lokasi Settings Healthcheck

### Langkah 1: Buka Railway Dashboard
1. Login ke https://railway.app
2. Pilih **Project** Anda
3. Klik pada **Service PHP** (bukan MySQL service)

### Langkah 2: Buka Settings Tab
1. Di service PHP, klik tab **"Settings"** (di bagian atas)
2. Scroll ke bawah sampai bagian **"Deploy"**

### Langkah 3: Set Healthcheck
Di bagian **"Deploy"**, Anda akan melihat:

**Healthcheck Path:**
```
/health
```
*(Isi dengan: `/health`)*

**Healthcheck Timeout:**
```
300
```
*(Isi dengan: `300` detik)*

**Start Command:**
```
php artisan serve --host=0.0.0.0 --port=$PORT
```

### Langkah 4: Save
1. Klik tombol **"Save"** atau **"Update"** di bagian bawah
2. Railway akan otomatis redeploy

## 📸 Visual Guide

```
Railway Dashboard
├── Your Project
    ├── PHP Service (klik ini)
        ├── Settings Tab (klik ini)
            └── Deploy Section
                ├── Healthcheck Path: /health
                ├── Healthcheck Timeout: 300
                └── Start Command: php artisan serve...
```

## ⚙️ Alternatif: Via railway.json

Jika tidak ada di Dashboard, file `railway.json` sudah dikonfigurasi:

```json
{
  "deploy": {
    "healthcheckPath": "/health",
    "healthcheckTimeout": 300
  }
}
```

Railway akan otomatis membaca file ini.

## ✅ Checklist

- [ ] Buka Railway Dashboard
- [ ] Pilih PHP Service (bukan MySQL)
- [ ] Klik tab "Settings"
- [ ] Scroll ke bagian "Deploy"
- [ ] Set Healthcheck Path: `/health`
- [ ] Set Healthcheck Timeout: `300`
- [ ] Klik "Save"
- [ ] Tunggu redeploy

## 🔍 Jika Tidak Ada Option Healthcheck

Beberapa Railway plan mungkin tidak menampilkan healthcheck settings. Dalam kasus ini:

1. **File `railway.json` sudah dikonfigurasi** - Railway akan otomatis membaca
2. **File `railway.toml` sudah dikonfigurasi** - Backup config
3. **Route `/health` sudah ada** - Akan otomatis digunakan

## 🚀 Setelah Set Healthcheck

1. Tunggu redeploy selesai
2. Cek logs untuk memastikan tidak ada error
3. Test healthcheck:
   ```
   curl https://parkirgym-production.up.railway.app/health
   ```

## 📝 Catatan

- Healthcheck Path harus sesuai dengan route yang ada
- Route `/health` sudah dibuat di `routes/web.php`
- Timeout 300 detik cukup untuk Laravel startup
- Jika masih error, cek logs di Railway Dashboard

