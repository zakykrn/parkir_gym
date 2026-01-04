# Smart Parking System - Laravel Version

Proyek ini telah dimigrasikan dari PHP native ke Laravel Framework.

## 📋 Persyaratan

- PHP >= 8.0
- Composer
- MySQL/MariaDB
- Extension PHP: PDO, OpenSSL, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath

## 🚀 Instalasi

### 1. Install Dependencies

```bash
composer install
```

### 2. Setup Environment

Copy file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parkir_otomatis
DB_USERNAME=root
DB_PASSWORD=
```

Untuk Railway, gunakan environment variables:
```env
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Seed Default Data (Opsional)

Jika perlu membuat admin default, jalankan:

```bash
php artisan tinker
```

Kemudian:
```php
$admin = new App\Models\Admin();
$admin->username = 'admin';
$admin->password = Hash::make('admin123');
$admin->nama = 'Administrator';
$admin->save();

$setting = new App\Models\Setting();
$setting->setting_key = 'tarif_per_jam';
$setting->setting_value = '5000';
$setting->description = 'Tarif parkir per jam dalam Rupiah';
$setting->save();
```

### 6. Setup Storage Link (jika perlu)

```bash
php artisan storage:link
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 📁 Struktur Proyek

```
smartparking-main/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   └── ParkirController.php
│   │   └── Middleware/
│   │       └── AdminAuth.php
│   └── Models/
│       ├── Admin.php
│       ├── Kendaraan.php
│       └── Setting.php
├── config/
│   ├── auth.php
│   └── database.php
├── database/
│   └── migrations/
├── public/
│   ├── css/
│   │   ├── admin.css
│   │   └── styles.css
│   └── index.php
├── resources/
│   └── views/
│       ├── admin/
│       ├── layouts/
│       └── parkir/
└── routes/
    ├── api.php
    └── web.php
```

## 🔐 Default Login Admin

- Username: `admin`
- Password: `admin123`

## 🌐 Routes

### Public Routes
- `/` - Halaman utama parkir

### Admin Routes
- `/admin/login` - Login admin
- `/admin/dashboard` - Dashboard admin
- `/admin/data` - Data parkir
- `/admin/settings` - Pengaturan

### API Routes
- `GET /api/kendaraan` - Get data kendaraan
- `POST /api/tambah-parkir` - Tambah parkir
- `POST /api/keluar-parkir` - Keluar parkir
- `GET /api/tarif` - Get tarif
- `GET /api/riwayat` - Get riwayat
- `POST /api/update-status` - Update status

## 📝 Catatan

1. File-file PHP native masih ada di root directory untuk referensi, tapi tidak digunakan lagi
2. Database tetap sama: `parkir_otomatis`
3. Tabel tetap sama: `t_kendaraan`, `t_admin`, `t_settings`
4. Fungsi dan tampilan tetap sama dengan versi PHP native

## 🗑️ File yang Bisa Dihapus (Setelah Verifikasi)

Setelah memastikan aplikasi Laravel berjalan dengan baik, file-file berikut bisa dihapus:

- `index.php` (old)
- `admin_*.php` (old)
- `getkendaraan.php`
- `tambahparkir.php`
- `keluarparkir.php`
- `get_tarif.php`
- `get_riwayat_user.php`
- `kirimdata.php`
- `config.php` (old)
- `admin_check.php`
- `setup_admin.php`
- `generate_admin_password.php`
- `cek_koneksi.php`
- `test_env.php`
- `debug_config.php`

**PENTING:** Backup dulu sebelum menghapus!

