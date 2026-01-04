# 🎯 Panduan Lengkap Railway Dashboard

## 📍 Lokasi Healthcheck Settings

### Step-by-Step:

1. **Login Railway:**
   - Buka: https://railway.app
   - Login dengan akun Anda

2. **Pilih Project:**
   - Klik pada project **"parkirgym-production"** atau nama project Anda

3. **Pilih Service:**
   - Klik pada **PHP Service** (bukan MySQL service)
   - Biasanya namanya seperti "web", "api", atau "php"

4. **Buka Settings:**
   - Klik tab **"Settings"** di bagian atas
   - Atau klik ikon ⚙️ Settings

5. **Scroll ke Deploy Section:**
   - Scroll ke bawah sampai bagian **"Deploy"**
   - Di sini Anda akan melihat:
     - **Start Command**
     - **Healthcheck Path** ← INI YANG PERLU DI-SET
     - **Healthcheck Timeout** ← INI JUGA

6. **Isi Healthcheck:**
   - **Healthcheck Path:** `/health`
   - **Healthcheck Timeout:** `300`

7. **Save:**
   - Klik tombol **"Save"** atau **"Update"**
   - Railway akan otomatis redeploy

## 🖼️ Struktur Menu

```
Railway Dashboard
│
├── Projects
│   └── parkirgym-production
│       │
│       ├── MySQL Service (JANGAN KLIK INI)
│       │
│       └── PHP/Web Service (KLIK INI) ←
│           │
│           ├── Deployments Tab
│           ├── Metrics Tab
│           ├── Logs Tab
│           ├── Variables Tab
│           │
│           └── Settings Tab ← KLIK INI
│               │
│               ├── General
│               │   ├── Name
│               │   ├── Root Directory
│               │   └── ...
│               │
│               └── Deploy ← SCROLL KE SINI
│                   ├── Start Command
│                   ├── Healthcheck Path ← SET: /health
│                   ├── Healthcheck Timeout ← SET: 300
│                   └── Restart Policy
```

## ⚠️ Jika Tidak Ada Healthcheck Settings

Jika tidak melihat option Healthcheck di Settings:

1. **Cek Railway Plan:**
   - Beberapa plan mungkin tidak menampilkan healthcheck settings
   - Upgrade ke Pro plan jika perlu

2. **Gunakan railway.json:**
   - File `railway.json` sudah dikonfigurasi
   - Railway akan otomatis membaca saat deploy

3. **Gunakan railway.toml:**
   - File `railway.toml` juga sudah dikonfigurasi
   - Sebagai backup config

## ✅ Quick Check

Setelah set healthcheck, verifikasi:

1. **Cek di Settings:**
   - Healthcheck Path: `/health` ✓
   - Healthcheck Timeout: `300` ✓

2. **Test Route:**
   ```bash
   curl https://parkirgym-production.up.railway.app/health
   ```
   Harus return: `{"status":"ok"}`

3. **Cek Logs:**
   - Railway Dashboard → Logs Tab
   - Pastikan tidak ada error

## 🎯 Summary

**Lokasi:** Railway Dashboard → Project → PHP Service → Settings Tab → Deploy Section

**Yang perlu di-set:**
- Healthcheck Path: `/health`
- Healthcheck Timeout: `300`

**Cara:**
1. Buka Settings tab
2. Scroll ke Deploy section
3. Isi healthcheck settings
4. Save
5. Tunggu redeploy

