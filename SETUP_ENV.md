# Setup File .env untuk Railway

## 📋 Langkah-langkah Setup

### 1. Buat File .env dari Template

Copy file `.env.example` menjadi `.env`:

**Windows:**
```cmd
copy .env.example .env
```

**Linux/Mac:**
```bash
cp .env.example .env
```

### 2. Dapatkan Nilai dari Railway

1. Buka Railway Dashboard: https://railway.app
2. Klik pada **MySQL service** Anda
3. Klik tab **"Variables"** atau **"Connect"**
4. Copy nilai-nilai berikut:
   - `MYSQLHOST` → Host database
   - `MYSQLUSER` → Username database
   - `MYSQLPASSWORD` → Password database
   - `MYSQLDATABASE` → Nama database
   - `MYSQLPORT` → Port (biasanya 3306)

### 3. Edit File .env

Buka file `.env` dan isi dengan nilai dari Railway:

```env
MYSQLHOST=monorail.proxy.rlwy.net
MYSQLUSER=root
MYSQLPASSWORD=Abc123Xyz456Def789
MYSQLDATABASE=railway
MYSQLPORT=3306
```

**Atau gunakan format alternatif:**

```env
DB_HOST=monorail.proxy.rlwy.net
DB_USER=root
DB_PASS=Abc123Xyz456Def789
DB_NAME=railway
DB_PORT=3306
```

### 4. Untuk Local Development (XAMPP)

Jika ingin menggunakan database lokal, gunakan:

```env
MYSQLHOST=localhost
MYSQLUSER=root
MYSQLPASSWORD=
MYSQLDATABASE=parkir_otomatis
MYSQLPORT=3306
```

## ⚠️ Catatan Penting

1. **File .env tidak akan di-commit ke Git** (sudah ada di .gitignore)
2. **Untuk Railway**: Environment variables biasanya di-set langsung di Railway dashboard, bukan dari file .env
3. **File .env berguna untuk**: Development lokal atau testing
4. **Config.php sudah otomatis load file .env** jika ada

## 🔍 Test Koneksi

Setelah setup, test koneksi dengan:

1. Akses: `http://localhost/smartparking-main/cek_koneksi.php`
2. Atau gunakan: `http://localhost/smartparking-main/test_env.php` untuk melihat environment variables

## 📝 Format yang Didukung

Config.php mendukung kedua format:

1. **Railway format**: `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`, `MYSQLPORT`
2. **Custom format**: `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_PORT`

Keduanya akan otomatis terdeteksi oleh `config.php`.

