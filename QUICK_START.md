# 🚀 Quick Start - Laravel Smart Parking

## ✅ Yang Sudah Siap
- ✅ PHP 8.4.10 terdeteksi
- ✅ Struktur Laravel sudah dibuat
- ✅ Composer.phar sudah didownload

## 📋 Langkah-langkah

### 1. Install Dependencies

Gunakan salah satu cara berikut:

**Cara A: Menggunakan composer.bat (Recommended)**
```powershell
.\composer.bat install
```

**Cara B: Langsung dengan PHP**
```powershell
php composer.phar install
```

### 2. Setup Environment

```powershell
copy .env.example .env
php artisan key:generate
```

### 3. Edit .env

Buka file `.env` dan sesuaikan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parkir_otomatis
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations

```powershell
php artisan migrate
```

**Catatan:** Jika tabel sudah ada, gunakan:
```powershell
php artisan migrate --force
```

### 5. Jalankan Server

```powershell
php artisan serve
```

### 6. Akses Aplikasi

- **Home:** http://localhost:8000
- **Admin Login:** http://localhost:8000/admin/login
  - Username: `admin`
  - Password: `admin123`

## 🔧 Troubleshooting

### Composer tidak dikenali
Gunakan `.\composer.bat` atau `php composer.phar` langsung

### Database connection error
- Pastikan MySQL di XAMPP sudah running
- Cek konfigurasi di `.env`
- Pastikan database `parkir_otomatis` sudah ada

### Migration error
Jika tabel sudah ada, skip migration atau gunakan `--force`

## 📝 Catatan

- File PHP native masih ada sebagai backup
- Database tetap sama, tidak perlu import ulang
- Semua fungsi dan tampilan tetap sama

