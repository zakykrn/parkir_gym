# Cara Install Composer di Windows

Composer diperlukan untuk menjalankan Laravel. Berikut cara install-nya:

## Metode 1: Install Composer via Installer (Paling Mudah)

1. **Download Composer Installer:**
   - Buka: https://getcomposer.org/download/
   - Klik "Composer-Setup.exe" untuk Windows
   - Download dan jalankan installer

2. **Saat Install:**
   - Installer akan otomatis detect PHP dari XAMPP
   - Jika tidak terdeteksi, browse ke: `C:\xampp\php\php.exe`
   - Klik "Install" dan tunggu selesai

3. **Verifikasi:**
   ```powershell
   composer --version
   ```

## Metode 2: Install Manual via PowerShell

1. **Download composer.phar:**
   ```powershell
   cd C:\xampp\htdocs\smartparking-main
   Invoke-WebRequest -Uri https://getcomposer.org/download/latest-stable/composer.phar -OutFile composer.phar
   ```

2. **Buat file composer.bat:**
   ```powershell
   @echo off
   php "%~dp0composer.phar" %*
   ```

3. **Pindahkan ke folder yang ada di PATH:**
   - Copy `composer.phar` dan `composer.bat` ke `C:\xampp\php\`
   - Atau tambahkan folder project ke PATH

## Metode 3: Gunakan PHP dari XAMPP Langsung

Jika Composer sudah terinstall tapi tidak dikenali:

1. **Cek PATH environment:**
   ```powershell
   $env:PATH
   ```

2. **Tambah PHP ke PATH (temporary):**
   ```powershell
   $env:PATH += ";C:\xampp\php"
   ```

3. **Atau gunakan full path:**
   ```powershell
   C:\xampp\php\php.exe C:\xampp\php\composer.phar install
   ```

## Setelah Composer Terinstall

1. **Install dependencies:**
   ```powershell
   composer install
   ```

2. **Setup .env:**
   ```powershell
   copy .env.example .env
   php artisan key:generate
   ```

3. **Run migrations:**
   ```powershell
   php artisan migrate
   ```

4. **Jalankan server:**
   ```powershell
   php artisan serve
   ```

## Catatan

- Pastikan PHP sudah ada di PATH
- XAMPP biasanya sudah include PHP di `C:\xampp\php\`
- Jika masih error, restart PowerShell setelah install Composer

