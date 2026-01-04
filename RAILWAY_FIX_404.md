# 🔧 Fix 404 Error di Railway

## Masalah
Railway menampilkan 404 karena tidak tahu ini aplikasi Laravel.

## Solusi Cepat

### Di Railway Dashboard:

1. **Settings → Root Directory:**
   - **KOSONGKAN** (biarkan default)
   - Jangan isi apapun!

2. **Settings → Build Command:**
   ```
   composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
   ```

3. **Settings → Start Command:**
   ```
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

4. **Variables → Tambahkan:**
   ```
   APP_KEY=base64:yM70qtNSlX7nDRMcn3SfQ+86Xq4XXg8lIfqxTs6R03A=
   APP_URL=https://parkirgym-production.up.railway.app
   APP_ENV=production
   APP_DEBUG=false
   ```

5. **Redeploy** - Klik "Redeploy" di Deployments

## File Konfigurasi yang Sudah Dibuat

✅ `nixpacks.toml` - Auto-detect oleh Railway
✅ `railway.json` - Konfigurasi deployment
✅ `Procfile` - Start command
✅ `public/.htaccess` - URL rewriting

## Setelah Redeploy

1. Tunggu build selesai
2. Cek logs untuk error
3. Jalankan migrations:
   ```
   php artisan migrate --force
   ```

## Masih Error?

Cek di Railway Dashboard → **Logs** untuk melihat error detail.

