<?php
// Konfigurasi Database
// Untuk XAMPP default: username = "root", password = "" (kosong)
// Jika Anda menggunakan konfigurasi MySQL berbeda, ubah di bawah ini:

// PASTIKAN KONFIGURASI DI BAWAH INI BENAR!
$servername = "localhost";
$db_username = "root";        // Default XAMPP: root (BUKAN 'admin'!)
$db_password = "";            // Default XAMPP: kosong (tidak ada password)
$dbname = "parkir_otomatis";

// Load .env file jika ada (untuk local development)
function loadEnvFile($envPath = __DIR__ . '/.env') {
    if (!file_exists($envPath)) {
        return;
    }
    
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                $value = substr($value, 1, -1);
            }
            
            // Set environment variable (skip template values)
            if (!empty($key) && !empty($value) && $value !== 'your_railway_mysql_host' && 
                $value !== 'your_database_host' && strpos($value, 'your_') !== 0) {
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
}

// Load .env file (hanya untuk local development, Railway menggunakan environment variables dari dashboard)
loadEnvFile();

// Membuat koneksi
function getConnection() {
    // Helper function untuk get env dengan multiple fallback
    $getEnv = function($keys, $default = null) {
        foreach ($keys as $key) {
            // Cek $_ENV dulu (lebih reliable)
            if (isset($_ENV[$key]) && !empty($_ENV[$key])) {
                return $_ENV[$key];
            }
            // Cek $_SERVER
            if (isset($_SERVER[$key]) && !empty($_SERVER[$key])) {
                return $_SERVER[$key];
            }
            // Cek getenv()
            $val = getenv($key);
            if ($val !== false && !empty($val)) {
                return $val;
            }
        }
        return $default;
    };
    
    // Railway menggunakan MYSQLHOST, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE, MYSQLPORT
    // Tapi juga support custom variables seperti DB_HOST, DB_USER, dll
    $servername = $getEnv(['MYSQLHOST', 'MYSQL_HOST', 'DB_HOST', 'DATABASE_HOST'], "localhost");
    $username = $getEnv(['MYSQLUSER', 'MYSQL_USER', 'DB_USER', 'DATABASE_USER'], "root");
    $password = $getEnv(['MYSQLPASSWORD', 'MYSQL_PASSWORD', 'DB_PASS', 'DB_PASSWORD', 'DATABASE_PASSWORD'], "");
    $dbname = $getEnv(['MYSQLDATABASE', 'MYSQL_DATABASE', 'DB_NAME', 'DATABASE_NAME'], "parkir_otomatis");
    $port = $getEnv(['MYSQLPORT', 'MYSQL_PORT', 'DB_PORT', 'DATABASE_PORT'], "3306");
    
    // Jika port bukan default dan tidak ada di host, tambahkan ke host
    if ($port != "3306" && strpos($servername, ':') === false) {
        $servername = $servername . ':' . $port;
    }
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        // Log error untuk debugging (jika error_log tersedia)
        if (function_exists('error_log')) {
            error_log("Database connection error: " . $conn->connect_error);
            error_log("Attempted connection with - Host: $servername, User: $username, DB: $dbname, Port: $port");
        }
        
        throw new Exception("Koneksi database gagal: " . $conn->connect_error . 
            " (Host: $servername, User: $username, DB: $dbname)");
    }
    
    return $conn;
}

// Mulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
