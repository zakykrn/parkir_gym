<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <title>Parkir Mobil Samping Gedung A</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>
    <div class="container">
        <header>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h1 style="flex: 1; margin: 0;">PARKIR MOBIL</h1>
                <a href="<?php echo e(route('admin.login')); ?>" class="admin-link" title="Login Admin">🔐 Admin</a>
            </div>
            <div id="user-info" class="user-info" style="display: none;">
                <div class="user-details">
                    <span id="user-name-display"></span>
                    <span id="user-plat-display"></span>
                </div>
                <div class="user-actions">
                    <button id="riwayat-btn" class="btn-action" title="Riwayat Parkir">📋 Riwayat</button>
                    <button id="logout-btn" class="btn-logout">Keluar</button>
                </div>
            </div>
            <div class="header-controls">
                <button id="refresh-btn" class="control-btn" title="Refresh Data">🔄</button>
                <button id="sound-toggle" class="control-btn" title="Toggle Sound">🔊</button>
                <button id="dark-mode-toggle" class="control-btn" title="Dark Mode">🌙</button>
            </div>
        </header>

        <div class="main-content">
            <!-- Legend Section -->
            <div class="legend-section">
                <div class="legend-title">KETERANGAN</div>
                <div class="legend-item">
                    <div class="legend-box lot-kosong"></div>
                    <span>SLOT KOSONG</span>
                </div>
                <div class="legend-item">
                    <div class="legend-box lot-isi"></div>
                    <span>SLOT ISI</span>
                </div>
                <div class="legend-item" style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #ddd;">
                    <div style="font-size: 14px; color: #666;">
                        <strong>Tarif:</strong> <span id="tarif-display">Rp 5.000</span> / jam
                    </div>
                </div>
            </div>

            <!-- Parking Area -->
            <div class="parking-area">
                <!-- Entry Arrow -->
                <div class="entry-section">
                    <div class="arrow-container entry-arrow">
                        <div class="arrow-line"></div>
                        <div class="arrow-head"></div>
                    </div>
                    <div class="entry-label">MASUK</div>
                </div>

                <!-- Row A (Top Row) -->
                <div class="parking-row row-a">
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="1" id="slot-A1">
                            <div class="slot-label">A1</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="1" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="2" id="slot-A2">
                            <div class="slot-label">A2</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="2" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="3" id="slot-A3">
                            <div class="slot-label">A3</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="3" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="4" id="slot-A4">
                            <div class="slot-label">A4</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="4" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                </div>

                <!-- Middle Space (for arrows) -->
                <div class="middle-space"></div>

                <!-- Row B (Bottom Row) -->
                <div class="parking-row row-b">
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="11" id="slot-B1">
                            <div class="slot-label">B1</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="11" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="12" id="slot-B2">
                            <div class="slot-label">B2</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="12" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="13" id="slot-B3">
                            <div class="slot-label">B3</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="13" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                    <div class="slot-wrapper">
                        <div class="slot" data-sensor="14" id="slot-B4">
                            <div class="slot-label">B4</div>
                            <div class="slot-status"></div>
                        </div>
                        <button class="btn-keluar-user" data-sensor="14" title="Keluar Parkir" style="display: none;">Keluar</button>
                    </div>
                </div>

                <!-- Exit Arrow -->
                <div class="exit-section">
                    <div class="exit-label">KELUAR</div>
                    <div class="arrow-container exit-arrow">
                        <div class="arrow-line"></div>
                        <div class="arrow-head"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Summary -->
        <div class="status-summary">
            <div class="summary-item">
                <span class="summary-label">Total Slot:</span>
                <span class="summary-value" id="total-slot">8</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Terisi:</span>
                <span class="summary-value" id="terisi-slot" style="color: #e74c3c;">0</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Kosong:</span>
                <span class="summary-value" id="kosong-slot" style="color: #27ae60;">8</span>
            </div>
        </div>
        
        <!-- Warning untuk durasi parkir lama -->
        <div id="durasi-warning" class="durasi-warning" style="display: none;">
            <span class="warning-icon">⚠️</span>
            <span class="warning-text">Anda sudah parkir lebih dari <strong id="warning-durasi">0</strong> jam. Total biaya: <strong id="warning-biaya">Rp 0</strong></span>
        </div>
    </div>

    <!-- Modal Login untuk Input Data Pengguna -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Masuk Parkir</h2>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="login-nama">Nama Pengguna:</label>
                        <input type="text" id="login-nama" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="login-plat-nomor">Plat Nomor:</label>
                        <input type="text" id="login-plat-nomor" name="plat_nomor" class="form-control" placeholder="Contoh: B 1234 XYZ" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-submit" style="width: 100%;">Masuk</button>
                    </div>
                </form>
                <div id="login-message" class="form-message"></div>
            </div>
        </div>
    </div>

    <!-- Modal Form untuk Input Data Parkir -->
    <div id="parkirModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Isi Slot Parkir</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="parkirForm">
                    <input type="hidden" id="selected-sensor" name="id_sensor" value="">
                    <div class="form-group">
                        <label for="slot-label">Slot Parkir:</label>
                        <input type="text" id="slot-label" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Pengguna:</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="plat_nomor">Plat Nomor:</label>
                        <input type="text" id="plat_nomor" name="plat_nomor" class="form-control" placeholder="Contoh: B 1234 XYZ" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="cancelBtn">Batal</button>
                        <button type="submit" class="btn btn-submit">Simpan</button>
                    </div>
                </form>
                <div id="form-message" class="form-message"></div>
            </div>
</div>
    </div>

    <!-- Modal Pembayaran -->
    <div id="paymentModal" class="modal">
        <div class="modal-content payment-modal-large">
            <div class="modal-header">
                <h2>Pembayaran Parkir</h2>
                <span class="close-payment">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Step 1: Detail Parkir -->
                <div id="payment-step-1" class="payment-step">
                    <div class="payment-content">
                        <div class="payment-item">
                            <div class="payment-label">Slot Parkir:</div>
                            <div class="payment-value" id="payment-slot-label">-</div>
                        </div>
                        <div class="payment-item">
                            <div class="payment-label">Nama:</div>
                            <div class="payment-value" id="payment-nama">-</div>
                        </div>
                        <div class="payment-item">
                            <div class="payment-label">Plat Nomor:</div>
                            <div class="payment-value" id="payment-plat-nomor">-</div>
                        </div>
                        <div class="payment-item">
                            <div class="payment-label">Waktu Masuk:</div>
                            <div class="payment-value" id="payment-waktu-masuk">-</div>
                        </div>
                        <div class="payment-item">
                            <div class="payment-label">Waktu Keluar:</div>
                            <div class="payment-value" id="payment-waktu-keluar">-</div>
                        </div>
                        <div class="payment-item">
                            <div class="payment-label">Durasi Parkir:</div>
                            <div class="payment-value" id="payment-durasi">-</div>
                        </div>
                        <div class="payment-divider"></div>
                        <div class="payment-item total">
                            <div class="payment-label">Total Biaya:</div>
                            <div class="payment-value" id="payment-total">Rp 0</div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="cancelPaymentBtn">Batal</button>
                        <button type="button" class="btn btn-submit" id="nextToPaymentBtn">Lanjut ke Pembayaran</button>
                    </div>
                </div>

                <!-- Step 2: Pilih Metode Pembayaran -->
                <div id="payment-step-2" class="payment-step" style="display: none;">
                    <h3 class="payment-step-title">Pilih Metode Pembayaran</h3>
                    <div class="payment-methods">
                        <div class="payment-method-card" data-method="tunai">
                            <div class="method-icon">💵</div>
                            <div class="method-name">Tunai</div>
                        </div>
                        <div class="payment-method-card" data-method="kartu_debit">
                            <div class="method-icon">💳</div>
                            <div class="method-name">Kartu Debit</div>
                        </div>
                        <div class="payment-method-card" data-method="kartu_kredit">
                            <div class="method-icon">💳</div>
                            <div class="method-name">Kartu Kredit</div>
                        </div>
                        <div class="payment-method-card" data-method="e_wallet">
                            <div class="method-icon">📱</div>
                            <div class="method-name">E-Wallet</div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="backToStep1Btn">Kembali</button>
                    </div>
                </div>

                <!-- Step 3: Input Pembayaran (untuk Tunai) -->
                <div id="payment-step-3-tunai" class="payment-step" style="display: none;">
                    <h3 class="payment-step-title">Pembayaran Tunai</h3>
                    <div class="payment-form">
                        <div class="form-group">
                            <label>Total Biaya:</label>
                            <div class="payment-amount-display" id="payment-amount-display">Rp 0</div>
                        </div>
                        <div class="form-group">
                            <label for="payment-cash-amount">Jumlah Pembayaran:</label>
                            <input type="number" id="payment-cash-amount" class="form-control" placeholder="Masukkan jumlah pembayaran" min="0" step="1000">
                            <small class="form-text">Masukkan jumlah uang yang dibayarkan</small>
                        </div>
                        <div class="payment-change" id="payment-change-section" style="display: none;">
                            <div class="change-label">Kembalian:</div>
                            <div class="change-amount" id="payment-change-amount">Rp 0</div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="backToStep2Btn">Kembali</button>
                        <button type="button" class="btn btn-submit" id="confirmCashPaymentBtn" disabled>Konfirmasi Pembayaran</button>
                    </div>
                </div>

                <!-- Step 3: Pilih E-Wallet (untuk E-Wallet) -->
                <div id="payment-step-3-ewallet" class="payment-step" style="display: none;">
                    <h3 class="payment-step-title">Pilih E-Wallet</h3>
                    <div class="payment-form">
                        <div class="form-group">
                            <label>Total Biaya:</label>
                            <div class="payment-amount-display" id="ewallet-amount-display">Rp 0</div>
                        </div>
                        <div class="form-group">
                            <label>Pilih E-Wallet:</label>
                            <div class="payment-options-grid">
                                <div class="payment-option-card" data-option="DANA">
                                    <div class="option-name">DANA</div>
                                </div>
                                <div class="payment-option-card" data-option="OVO">
                                    <div class="option-name">OVO</div>
                                </div>
                                <div class="payment-option-card" data-option="GoPay">
                                    <div class="option-name">GoPay</div>
                                </div>
                                <div class="payment-option-card" data-option="ShopeePay">
                                    <div class="option-name">ShopeePay</div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-info-box">
                            <p>Pilih salah satu e-wallet untuk melanjutkan pembayaran.</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="backToStep2FromEwallet">Kembali</button>
                    </div>
                </div>

                <!-- Step 3: Pilih Bank (untuk Kartu Debit) -->
                <div id="payment-step-3-bank" class="payment-step" style="display: none;">
                    <h3 class="payment-step-title">Pilih Bank</h3>
                    <div class="payment-form">
                        <div class="form-group">
                            <label>Total Biaya:</label>
                            <div class="payment-amount-display" id="bank-amount-display">Rp 0</div>
                        </div>
                        <div class="form-group">
                            <label>Pilih Bank:</label>
                            <div class="payment-options-grid">
                                <div class="payment-option-card" data-option="BRI">
                                    <div class="option-name">BRI</div>
                                </div>
                                <div class="payment-option-card" data-option="BNI">
                                    <div class="option-name">BNI</div>
                                </div>
                                <div class="payment-option-card" data-option="MANDIRI">
                                    <div class="option-name">MANDIRI</div>
                                </div>
                                <div class="payment-option-card" data-option="BCA">
                                    <div class="option-name">BCA</div>
                                </div>
                                <div class="payment-option-card" data-option="BSI">
                                    <div class="option-name">BSI</div>
                                </div>
                                <div class="payment-option-card" data-option="BRK">
                                    <div class="option-name">BRK</div>
                                </div>
                                <div class="payment-option-card" data-option="CIMB">
                                    <div class="option-name">CIMB</div>
                                </div>
                                <div class="payment-option-card" data-option="PERMATA">
                                    <div class="option-name">PERMATA</div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-info-box">
                            <p>Pilih salah satu bank untuk melanjutkan pembayaran.</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="backToStep2FromBank">Kembali</button>
                    </div>
                </div>

                <!-- Step 4: Konfirmasi (untuk Non-Tunai setelah pilih e-wallet/bank) -->
                <div id="payment-step-4-confirm" class="payment-step" style="display: none;">
                    <h3 class="payment-step-title" id="confirm-method-title">Konfirmasi Pembayaran</h3>
                    <div class="payment-form">
                        <div class="form-group">
                            <label>Metode Pembayaran:</label>
                            <div class="payment-method-display" id="confirm-method-display">-</div>
                        </div>
                        <div class="form-group">
                            <label>Kode Pembayaran:</label>
                            <div class="payment-code-display" id="confirm-payment-code">-</div>
                            <small class="form-text" style="text-align: center; display: block; margin-top: 5px; color: #666;">Gunakan kode ini untuk pembayaran</small>
                        </div>
                        <div class="form-group">
                            <label>Total Biaya:</label>
                            <div class="payment-amount-display" id="confirm-amount-display">Rp 0</div>
                        </div>
                        <div class="payment-info-box">
                            <p><strong>Instruksi Pembayaran:</strong></p>
                            <p id="confirm-instruction">Pastikan pembayaran sudah dilakukan melalui metode yang dipilih dengan kode pembayaran di atas.</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" id="backToOptionBtn">Kembali</button>
                        <button type="button" class="btn btn-submit" id="confirmNonCashPaymentBtn">Konfirmasi Pembayaran</button>
                    </div>
                </div>

                <!-- Step 5: Proses Pembayaran -->
                <div id="payment-step-5-process" class="payment-step" style="display: none;">
                    <div class="payment-processing">
                        <div class="processing-spinner">
                            <div class="spinner"></div>
                        </div>
                        <h3>Memproses Pembayaran...</h3>
                        <p>Mohon tunggu, transaksi sedang diproses</p>
                    </div>
                </div>

                <!-- Step 6: Berhasil -->
                <div id="payment-step-6-success" class="payment-step" style="display: none;">
                    <div class="payment-success">
                        <div class="success-icon">✅</div>
                        <h3>Pembayaran Berhasil!</h3>
                        <p id="payment-success-message">Transaksi Anda telah berhasil diproses.</p>
                        <div class="payment-summary" id="payment-summary">
                            <!-- Summary akan diisi oleh JavaScript -->
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="printReceiptBtn">🖨️ Print Struk</button>
                        <button type="button" class="btn btn-submit" id="closePaymentSuccessBtn">Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info untuk Slot Terisi -->
    <div id="infoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Informasi Slot Parkir</h2>
                <span class="close-info">&times;</span>
            </div>
            <div class="modal-body">
                <div class="info-content">
                    <div class="info-item">
                        <div class="info-label">Slot Parkir:</div>
                        <div class="info-value" id="info-slot-label">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Status:</div>
                        <div class="info-value status-badge" id="info-status">Terisi</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Nama Pengguna:</div>
                        <div class="info-value" id="info-nama">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Plat Nomor:</div>
                        <div class="info-value" id="info-plat-nomor">-</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Waktu Masuk:</div>
                        <div class="info-value" id="info-waktu-masuk">-</div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-close-info" id="closeInfoBtn">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Memproses...</p>
        </div>
    </div>

    <!-- Modal Riwayat Parkir -->
    <div id="riwayatModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Riwayat Parkir</h2>
                <span class="close-riwayat">&times;</span>
            </div>
            <div class="modal-body">
                <div id="riwayat-content">
                    <p style="text-align: center; color: #666;">Memuat riwayat...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt untuk Print (Hidden) -->
    <div id="receipt-content" style="display: none;">
        <div class="receipt">
            <div class="receipt-header">
                <h2>PARKIR MOBIL</h2>
                <p>STRUK PEMBAYARAN</p>
            </div>
            <div class="receipt-body">
                <div class="receipt-item">
                    <span>Slot Parkir:</span>
                    <span id="receipt-slot">-</span>
                </div>
                <div class="receipt-item">
                    <span>Nama:</span>
                    <span id="receipt-nama">-</span>
                </div>
                <div class="receipt-item">
                    <span>Plat Nomor:</span>
                    <span id="receipt-plat">-</span>
                </div>
                <div class="receipt-item">
                    <span>Waktu Masuk:</span>
                    <span id="receipt-masuk">-</span>
                </div>
                <div class="receipt-item">
                    <span>Waktu Keluar:</span>
                    <span id="receipt-keluar">-</span>
                </div>
                <div class="receipt-item">
                    <span>Durasi:</span>
                    <span id="receipt-durasi">-</span>
                </div>
                <div class="receipt-divider"></div>
                <div class="receipt-item receipt-total">
                    <span>Total Biaya:</span>
                    <span id="receipt-total">Rp 0</span>
                </div>
            </div>
            <div class="receipt-footer">
                <p>Terima Kasih</p>
                <p id="receipt-date">-</p>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
            var selectedSlot = null;
            var selectedSensorId = null;
            var currentUser = null;
            var userSlotId = null; // Track which slot the current user occupies
            
            // Tarif parkir per jam (akan di-load dari server)
            var tarifPerJam = 5000; // Default, akan di-update dari server

            // Modal handlers
            var loginModal = $('#loginModal');
            var modal = $('#parkirModal');
            var infoModal = $('#infoModal');
            var closeBtn = $('.close');
            var closeInfoBtn = $('.close-info, #closeInfoBtn');
            var cancelBtn = $('#cancelBtn');
            
            // Store parking data
            var parkingData = {};
            
            // Toast Notification System
            function showToast(message, type = 'info', duration = 3000) {
                type = type || 'info';
                var icons = {
                    success: '✅',
                    error: '❌',
                    warning: '⚠️',
                    info: 'ℹ️'
                };
                
                var titles = {
                    success: 'Berhasil',
                    error: 'Error',
                    warning: 'Peringatan',
                    info: 'Informasi'
                };
                
                var toast = $('<div>').addClass('toast ' + type);
                toast.html(
                    '<span class="toast-icon">' + icons[type] + '</span>' +
                    '<div class="toast-content">' +
                        '<div class="toast-title">' + titles[type] + '</div>' +
                        '<div class="toast-message">' + message + '</div>' +
                    '</div>' +
                    '<button class="toast-close">&times;</button>'
                );
                
                $('#toast-container').append(toast);
                
                // Auto remove after duration
                var timeout = setTimeout(function() {
                    removeToast(toast);
                }, duration);
                
                // Close button
                toast.find('.toast-close').on('click', function() {
                    clearTimeout(timeout);
                    removeToast(toast);
                });
            }
            
            function removeToast(toast) {
                toast.addClass('hiding');
                setTimeout(function() {
                    toast.remove();
                }, 300);
            }
            
            // Loading Indicator
            function showLoading(message) {
                if (message) {
                    $('#loading-overlay .loading-spinner p').text(message);
                }
                $('#loading-overlay').fadeIn(200);
            }
            
            function hideLoading() {
                $('#loading-overlay').fadeOut(200);
            }
            
            // Auto-uppercase untuk plat nomor
            $('#login-plat-nomor, #plat_nomor').on('input', function() {
                $(this).val($(this).val().toUpperCase());
            });
            
            // Validasi format plat nomor Indonesia (contoh: B 1234 XYZ, AB 1234 CD)
            function validatePlatNomor(plat) {
                // Format: 1-2 huruf, spasi, 1-4 angka, spasi, 1-3 huruf
                var pattern = /^[A-Z]{1,2}\s\d{1,4}\s[A-Z]{1,3}$/;
                return pattern.test(plat);
            }
            
            // Sound notification
            var soundEnabled = localStorage.getItem('soundEnabled') !== 'false';
            var audioContext = null;
            
            function playSound() {
                if (!soundEnabled) return;
                
                try {
                    if (!audioContext) {
                        audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    }
                    
                    var oscillator = audioContext.createOscillator();
                    var gainNode = audioContext.createGain();
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);
                    
                    oscillator.frequency.value = 800;
                    oscillator.type = 'sine';
                    
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
                    
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.3);
                } catch (e) {
                    console.error('Error playing sound:', e);
                }
            }
            
            // Dark Mode
            var darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                $('body').addClass('dark-mode');
                $('#dark-mode-toggle').text('☀️');
            }
            
            // Initialize controls
            if (!soundEnabled) {
                $('#sound-toggle').addClass('muted').text('🔇');
            }
            
            // Refresh button
            $('#refresh-btn').on('click', function() {
                $(this).css('transform', 'rotate(360deg)');
                fetchData();
                setTimeout(function() {
                    $('#refresh-btn').css('transform', 'rotate(0deg)');
                }, 500);
                showToast('Data diperbarui', 'info', 2000);
            });
            
            // Sound toggle
            $('#sound-toggle').on('click', function() {
                soundEnabled = !soundEnabled;
                localStorage.setItem('soundEnabled', soundEnabled);
                if (soundEnabled) {
                    $(this).removeClass('muted').text('🔊');
                    playSound();
                } else {
                    $(this).addClass('muted').text('🔇');
                }
            });
            
            // Dark mode toggle
            $('#dark-mode-toggle').on('click', function() {
                darkMode = !darkMode;
                localStorage.setItem('darkMode', darkMode);
                if (darkMode) {
                    $('body').addClass('dark-mode');
                    $(this).text('☀️');
                } else {
                    $('body').removeClass('dark-mode');
                    $(this).text('🌙');
                }
            });
            
            // Riwayat parkir
            var riwayatModal = $('#riwayatModal');
            $('#riwayat-btn').on('click', function() {
                if (!currentUser) {
                    showToast('Silakan login terlebih dahulu', 'warning');
                    return;
                }
                
                riwayatModal.css('display', 'block');
                loadRiwayat();
            });
            
            $('.close-riwayat').on('click', function() {
                riwayatModal.css('display', 'none');
            });
            
            $(window).on('click', function(event) {
                if ($(event.target).is(riwayatModal)) {
                    riwayatModal.css('display', 'none');
                }
            });
            
            function loadRiwayat() {
                if (!currentUser) return;
                
                $('#riwayat-content').html('<p style="text-align: center; color: #666;">Memuat riwayat...</p>');
                
                $.get('<?php echo e(route("api.riwayat")); ?>', {
                    nama: currentUser.nama,
                    plat_nomor: currentUser.plat_nomor
                }, function(response) {
                    try {
                        var data = typeof response === 'string' ? JSON.parse(response) : response;
                        if (data.success && data.data.length > 0) {
                            var html = '<table class="riwayat-table"><thead><tr>' +
                                '<th>Tanggal</th><th>Slot</th><th>Waktu Masuk</th><th>Waktu Keluar</th><th>Durasi</th><th>Biaya</th>' +
                                '</tr></thead><tbody>';
                            
                            data.data.forEach(function(item) {
                                var masuk = new Date(item.waktu_masuk);
                                var keluar = new Date(item.waktu_keluar);
                                var durasi = Math.ceil((keluar - masuk) / (1000 * 60 * 60));
                                
                                html += '<tr>' +
                                    '<td>' + masuk.toLocaleDateString('id-ID') + '</td>' +
                                    '<td><strong>' + item.slot_label + '</strong></td>' +
                                    '<td>' + masuk.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'}) + '</td>' +
                                    '<td>' + keluar.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'}) + '</td>' +
                                    '<td>' + durasi + ' jam</td>' +
                                    '<td><strong>Rp ' + parseFloat(item.biaya).toLocaleString('id-ID') + '</strong></td>' +
                                    '</tr>';
                            });
                            
                            html += '</tbody></table>';
                            $('#riwayat-content').html(html);
                        } else {
                            $('#riwayat-content').html('<div class="riwayat-empty">Belum ada riwayat parkir</div>');
                        }
                    } catch (e) {
                        $('#riwayat-content').html('<div class="riwayat-empty">Error: ' + e.message + '</div>');
                    }
                }).fail(function() {
                    $('#riwayat-content').html('<div class="riwayat-empty">Gagal memuat riwayat</div>');
                });
            }
            
            // Print receipt
            $(document).on('click', '#printReceiptBtn', function() {
                printReceipt();
            });
            
            function printReceipt() {
                // Get payment data from modal
                var slotLabel = $('#payment-slot-label').text();
                var nama = $('#payment-nama').text();
                var plat = $('#payment-plat-nomor').text();
                var masuk = $('#payment-waktu-masuk').text();
                var keluar = $('#payment-waktu-keluar').text();
                var durasi = $('#payment-durasi').text();
                var total = $('#payment-total').text();
                var method = selectedPaymentMethod ? getMethodName(selectedPaymentMethod) : 'Tunai';
                if (selectedPaymentDetail) {
                    method += ' (' + selectedPaymentDetail + ')';
                }
                
                // Fill receipt data
                $('#receipt-slot').text(slotLabel || '-');
                $('#receipt-nama').text(nama || '-');
                $('#receipt-plat').text(plat || '-');
                $('#receipt-masuk').text(masuk || '-');
                $('#receipt-keluar').text(keluar || '-');
                $('#receipt-durasi').text(durasi || '-');
                $('#receipt-total').text(total || 'Rp 0');
                $('#receipt-date').text(new Date().toLocaleString('id-ID'));
                
                // Add payment method to receipt if available
                var receiptBody = $('#receipt-content .receipt-body');
                var methodItem = receiptBody.find('#receipt-method');
                if (methodItem.length === 0) {
                    $('#receipt-durasi').parent().after('<div class="receipt-item"><span>Metode Pembayaran:</span><span id="receipt-method">' + method + '</span></div>');
                } else {
                    $('#receipt-method').text(method);
                }
                
                // Show and print
                $('#receipt-content').css('display', 'block');
                window.print();
                $('#receipt-content').css('display', 'none');
            }
            
            // Peringatan durasi parkir
            var durasiWarningShown = false;
            function checkDurasiParkir() {
                if (!currentUser || !userSlotId) return;
                
                var data = parkingData[userSlotId];
                if (!data || !data.waktu_masuk) return;
                
                var waktuMasuk = new Date(data.waktu_masuk.replace(' ', 'T'));
                var sekarang = new Date();
                var durasiJam = Math.ceil((sekarang - waktuMasuk) / (1000 * 60 * 60));
                
                // Tampilkan warning jika lebih dari 3 jam
                if (durasiJam > 3) {
                    var biayaEstimasi = durasiJam * tarifPerJam;
                    $('#warning-durasi').text(durasiJam);
                    $('#warning-biaya').text('Rp ' + biayaEstimasi.toLocaleString('id-ID'));
                    $('#durasi-warning').fadeIn();
                    durasiWarningShown = true;
                } else {
                    $('#durasi-warning').fadeOut();
                    durasiWarningShown = false;
                }
            }
            
            // Check durasi setiap menit
            setInterval(function() {
                if (currentUser && userSlotId) {
                    checkDurasiParkir();
                }
            }, 60000); // Check every minute
            
            // Load tarif dari server
            function loadTarif() {
                $.get("<?php echo e(route('api.tarif')); ?>", function(response) {
                    try {
                        var data = typeof response === 'string' ? JSON.parse(response) : response;
                        if (data.success && data.tarif_per_jam) {
                            tarifPerJam = parseFloat(data.tarif_per_jam);
                            // Update display tarif
                            $('#tarif-display').text('Rp ' + tarifPerJam.toLocaleString('id-ID'));
                        }
                    } catch (e) {
                        console.error('Error loading tarif:', e);
                    }
                }).fail(function() {
                    console.error('Failed to load tarif, using default:', tarifPerJam);
                });
            }

            // Check if user is logged in
            function checkLogin() {
                var savedUser = localStorage.getItem('parkingUser');
                if (savedUser) {
                    currentUser = JSON.parse(savedUser);
                    showUserInfo();
                    // Check if user has an occupied slot
                    checkUserSlot();
                } else {
                    // Show login modal
                    loginModal.css('display', 'block');
                }
            }

            // Show user info in header
            function showUserInfo() {
                if (currentUser) {
                    $('#user-name-display').text(currentUser.nama);
                    $('#user-plat-display').text('(' + currentUser.plat_nomor + ')');
                    $('#user-info').show();
                }
            }

            // Check which slot the current user occupies
            function checkUserSlot() {
                if (!currentUser) return;
                
                for (var sensorId in parkingData) {
                    var data = parkingData[sensorId];
                    if (data && data.nama === currentUser.nama && data.plat_nomor === currentUser.plat_nomor) {
                        userSlotId = parseInt(sensorId);
                        // Show exit button for user's slot
                        $('.btn-keluar-user[data-sensor="' + userSlotId + '"]').show();
                        break;
                    }
                }
            }

            // Login form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                var nama = $('#login-nama').val().trim();
                var plat_nomor = $('#login-plat-nomor').val().trim().toUpperCase();
                
                if (!nama || !plat_nomor) {
                    showLoginMessage('Mohon lengkapi semua field!', 'error');
                    return;
                }
                
                // Validasi format plat nomor
                if (!validatePlatNomor(plat_nomor)) {
                    showLoginMessage('Format plat nomor tidak valid! Contoh: B 1234 XYZ atau AB 1234 CD', 'error');
                    return;
                }
                
                // Save user data (plat_nomor sudah di-uppercase di validasi)
                currentUser = {
                    nama: nama,
                    plat_nomor: plat_nomor
                };
                localStorage.setItem('parkingUser', JSON.stringify(currentUser));
                
                // Close login modal and show user info
                loginModal.css('display', 'none');
                showUserInfo();
                checkUserSlot();
            });

            // Logout function
            $('#logout-btn').on('click', function() {
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    localStorage.removeItem('parkingUser');
                    currentUser = null;
                    userSlotId = null;
                    $('#user-info').hide();
                    $('.btn-keluar-user').hide();
                    loginModal.css('display', 'block');
                }
            });

            // Handle exit button click - show payment modal
            $(document).on('click', '.btn-keluar-user', function(e) {
                e.stopPropagation();
                var sensorId = parseInt($(this).attr('data-sensor'));
                var slotLabel = $('.slot[data-sensor="' + sensorId + '"]').find('.slot-label').text();
                var data = parkingData[sensorId];
                
                if (data) {
                    // Calculate parking duration and cost
                    var waktuMasuk = data.waktu_masuk;
                    var waktuKeluar = new Date();
                    
                    // Format waktu masuk
                    var waktuMasukStr = waktuMasuk;
                    if (waktuMasukStr.indexOf('T') === -1 && waktuMasukStr.indexOf(' ') !== -1) {
                        waktuMasukStr = waktuMasukStr.replace(' ', 'T');
                    }
                    var waktuMasukDate = new Date(waktuMasukStr);
                    
                    // Calculate duration in hours
                    var durasiMs = waktuKeluar - waktuMasukDate;
                    var durasiMenit = Math.floor(durasiMs / (1000 * 60));
                    var durasiJam = Math.ceil(durasiMs / (1000 * 60 * 60)); // Round up to hours
                    if (durasiJam < 1) durasiJam = 1; // Minimum 1 hour
                    
                    // Calculate cost menggunakan tarif dari server
                    var totalBiaya = durasiJam * tarifPerJam;
                    
                    // Format duration display
                    var durasiText = '';
                    if (durasiJam >= 24) {
                        var hari = Math.floor(durasiJam / 24);
                        var jam = durasiJam % 24;
                        durasiText = hari + ' hari ' + jam + ' jam';
                    } else {
                        durasiText = durasiJam + ' jam';
                        if (durasiMenit % 60 > 0) {
                            durasiText += ' (' + durasiMenit + ' menit)';
                        }
                    }
                    
                    // Format dates
                    var options = { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        timeZone: 'Asia/Jakarta'
                    };
                    
                    // Fill payment modal
                    $('#payment-slot-label').text(slotLabel);
                    $('#payment-nama').text(data.nama || '-');
                    $('#payment-plat-nomor').text(data.plat_nomor || '-');
                    $('#payment-waktu-masuk').text(waktuMasukDate.toLocaleDateString('id-ID', options));
                    $('#payment-waktu-keluar').text(waktuKeluar.toLocaleDateString('id-ID', options));
                    $('#payment-durasi').text(durasiText);
                    $('#payment-total').text('Rp ' + totalBiaya.toLocaleString('id-ID'));
                    
                    // Store sensor ID and total for payment
                    $('#paymentModal').data('sensor-id', sensorId);
                    paymentTotal = totalBiaya;
                    
                    // Store payment data for print receipt
                    $('#paymentModal').data('payment-data', {
                        slotLabel: slotLabel,
                        nama: data.nama,
                        plat_nomor: data.plat_nomor,
                        waktuMasuk: waktuMasukDate.toLocaleDateString('id-ID', options),
                        waktuKeluar: waktuKeluar.toLocaleDateString('id-ID', options),
                        durasi: durasiText,
                        total: totalBiaya
                    });
                    
                    // Reset and show payment modal
                    resetPaymentModal();
                    $('#paymentModal').css('display', 'block');
                }
            });
            
            // Payment modal handlers
            var paymentModal = $('#paymentModal');
            var closePaymentBtn = $('.close-payment, #cancelPaymentBtn');
            var selectedPaymentMethod = null;
            var selectedPaymentDetail = null; // Untuk e-wallet atau bank yang dipilih
            var paymentCode = null; // Kode pembayaran
            var paymentTotal = 0;
            
            // Function to generate payment code
            function generatePaymentCode(method, detail) {
                var prefix = '';
                if (method === 'e_wallet') {
                    prefix = 'EW';
                } else if (method === 'kartu_debit') {
                    prefix = 'BK';
                } else if (method === 'kartu_kredit') {
                    prefix = 'CC';
                }
                
                // Generate random 6 digit number
                var randomNum = Math.floor(100000 + Math.random() * 900000);
                return prefix + '-' + randomNum;
            }
            
            // Reset payment modal
            function resetPaymentModal() {
                $('#payment-step-1').show();
                $('#payment-step-2').hide();
                $('#payment-step-3-tunai').hide();
                $('#payment-step-3-ewallet').hide();
                $('#payment-step-3-bank').hide();
                $('#payment-step-4-confirm').hide();
                $('#payment-step-5-process').hide();
                $('#payment-step-6-success').hide();
                selectedPaymentMethod = null;
                selectedPaymentDetail = null;
                paymentCode = null;
                $('.payment-method-card').removeClass('selected');
                $('.payment-option-card').removeClass('selected');
                $('#payment-cash-amount').val('');
                $('#payment-change-section').hide();
            }
            
            closePaymentBtn.on('click', function() {
                resetPaymentModal();
                paymentModal.css('display', 'none');
            });
            
            $(window).on('click', function(event) {
                if ($(event.target).is(paymentModal)) {
                    resetPaymentModal();
                    paymentModal.css('display', 'none');
                }
            });
            
            // Step 1: Next to payment method selection
            $('#nextToPaymentBtn').on('click', function() {
                $('#payment-step-1').hide();
                $('#payment-step-2').show();
            });
            
            // Step 2: Back to step 1
            $('#backToStep1Btn').on('click', function() {
                $('#payment-step-2').hide();
                $('#payment-step-1').show();
                selectedPaymentMethod = null;
                selectedPaymentDetail = null;
                $('.payment-method-card').removeClass('selected');
            });
            
            // Step 3: Back from cash to step 2
            $('#backToStep2Btn').on('click', function() {
                $('#payment-step-3-tunai').hide();
                $('#payment-step-2').show();
                selectedPaymentMethod = null;
                selectedPaymentDetail = null;
                $('.payment-method-card').removeClass('selected');
                $('#payment-cash-amount').val('');
                $('#payment-change-section').hide();
            });
            
            // Step 2: Select payment method
            $('.payment-method-card').on('click', function() {
                $('.payment-method-card').removeClass('selected');
                $(this).addClass('selected');
                selectedPaymentMethod = $(this).data('method');
                selectedPaymentDetail = null; // Reset detail
                
                // Show appropriate step 3
                setTimeout(function() {
                    $('#payment-step-2').hide();
                    if (selectedPaymentMethod === 'tunai') {
                        $('#payment-step-3-tunai').show();
                        $('#payment-amount-display').text($('#payment-total').text());
                    } else if (selectedPaymentMethod === 'e_wallet') {
                        $('#payment-step-3-ewallet').show();
                        $('#ewallet-amount-display').text($('#payment-total').text());
                    } else if (selectedPaymentMethod === 'kartu_debit') {
                        $('#payment-step-3-bank').show();
                        $('#bank-amount-display').text($('#payment-total').text());
                    } else {
                        // Kartu kredit langsung ke konfirmasi
                        paymentCode = generatePaymentCode('kartu_kredit', null);
                        $('#payment-step-4-confirm').show();
                        $('#confirm-amount-display').text($('#payment-total').text());
                        $('#confirm-method-display').text('Kartu Kredit');
                        $('#confirm-method-title').text('Konfirmasi Pembayaran - Kartu Kredit');
                        $('#confirm-payment-code').text(paymentCode);
                        $('#confirm-instruction').html('Gunakan kode pembayaran di atas untuk melakukan pembayaran dengan Kartu Kredit.');
                    }
                }, 300);
            });
            
            // Step 3: Cash payment - calculate change
            $('#payment-cash-amount').on('input', function() {
                var cashAmount = parseFloat($(this).val()) || 0;
                var total = paymentTotal;
                
                if (cashAmount >= total) {
                    var change = cashAmount - total;
                    $('#payment-change-amount').text('Rp ' + change.toLocaleString('id-ID'));
                    $('#payment-change-section').fadeIn();
                    $('#confirmCashPaymentBtn').prop('disabled', false);
                } else {
                    $('#payment-change-section').fadeOut();
                    $('#confirmCashPaymentBtn').prop('disabled', true);
                }
            });
            
            // Step 3: Confirm cash payment
            $('#confirmCashPaymentBtn').on('click', function() {
                var cashAmount = parseFloat($('#payment-cash-amount').val());
                if (cashAmount < paymentTotal) {
                    showToast('Jumlah pembayaran tidak mencukupi!', 'error');
                    return;
                }
                processPayment();
            });
            
            // Step 3: Back from e-wallet to step 2
            $('#backToStep2FromEwallet').on('click', function() {
                $('#payment-step-3-ewallet').hide();
                $('#payment-step-2').show();
                selectedPaymentDetail = null;
                $('.payment-option-card').removeClass('selected');
            });
            
            // Step 3: Back from bank to step 2
            $('#backToStep2FromBank').on('click', function() {
                $('#payment-step-3-bank').hide();
                $('#payment-step-2').show();
                selectedPaymentDetail = null;
                $('.payment-option-card').removeClass('selected');
            });
            
            // Step 3: Select e-wallet
            $(document).on('click', '#payment-step-3-ewallet .payment-option-card', function() {
                $('#payment-step-3-ewallet .payment-option-card').removeClass('selected');
                $(this).addClass('selected');
                selectedPaymentDetail = $(this).data('option');
                
                // Generate payment code
                paymentCode = generatePaymentCode('e_wallet', selectedPaymentDetail);
                
                // Show confirmation step
                setTimeout(function() {
                    $('#payment-step-3-ewallet').hide();
                    $('#payment-step-4-confirm').show();
                    $('#confirm-amount-display').text($('#payment-total').text());
                    $('#confirm-method-display').text('E-Wallet (' + selectedPaymentDetail + ')');
                    $('#confirm-method-title').text('Konfirmasi Pembayaran - E-Wallet (' + selectedPaymentDetail + ')');
                    $('#confirm-payment-code').text(paymentCode);
                    $('#confirm-instruction').html('Lakukan transfer/pembayaran melalui <strong>' + selectedPaymentDetail + '</strong> dengan kode pembayaran di atas.');
                }, 300);
            });
            
            // Step 3: Select bank
            $(document).on('click', '#payment-step-3-bank .payment-option-card', function() {
                $('#payment-step-3-bank .payment-option-card').removeClass('selected');
                $(this).addClass('selected');
                selectedPaymentDetail = $(this).data('option');
                
                // Generate payment code
                paymentCode = generatePaymentCode('kartu_debit', selectedPaymentDetail);
                
                // Show confirmation step
                setTimeout(function() {
                    $('#payment-step-3-bank').hide();
                    $('#payment-step-4-confirm').show();
                    $('#confirm-amount-display').text($('#payment-total').text());
                    $('#confirm-method-display').text('Kartu Debit (' + selectedPaymentDetail + ')');
                    $('#confirm-method-title').text('Konfirmasi Pembayaran - Kartu Debit (' + selectedPaymentDetail + ')');
                    $('#confirm-payment-code').text(paymentCode);
                    $('#confirm-instruction').html('Lakukan transfer melalui <strong>' + selectedPaymentDetail + '</strong> dengan kode pembayaran di atas.');
                }, 300);
            });
            
            // Step 4: Back to option selection
            $('#backToOptionBtn').on('click', function() {
                $('#payment-step-4-confirm').hide();
                if (selectedPaymentMethod === 'e_wallet') {
                    $('#payment-step-3-ewallet').show();
                } else if (selectedPaymentMethod === 'kartu_debit') {
                    $('#payment-step-3-bank').show();
                } else {
                    $('#payment-step-2').show();
                }
            });
            
            // Step 4: Confirm non-cash payment
            $('#confirmNonCashPaymentBtn').on('click', function() {
                processPayment();
            });
            
            // Process payment
            function processPayment() {
                if (!selectedPaymentMethod) {
                    showToast('Pilih metode pembayaran terlebih dahulu!', 'error');
                    return;
                }
                
                // Validate detail untuk e-wallet dan kartu debit
                if ((selectedPaymentMethod === 'e_wallet' || selectedPaymentMethod === 'kartu_debit') && !selectedPaymentDetail) {
                    showToast('Pilih e-wallet/bank terlebih dahulu!', 'error');
                    return;
                }
                
                var sensorId = paymentModal.data('sensor-id');
                if (!sensorId) {
                    showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    return;
                }
                
                // Build metode pembayaran dengan detail
                var metodePembayaran = selectedPaymentMethod;
                if (selectedPaymentDetail) {
                    metodePembayaran = selectedPaymentMethod + ' (' + selectedPaymentDetail + ')';
                }
                
                // Show processing step
                $('#payment-step-3-tunai').hide();
                $('#payment-step-3-ewallet').hide();
                $('#payment-step-3-bank').hide();
                $('#payment-step-4-confirm').hide();
                $('#payment-step-5-process').show();
                
                // Process payment
                $.ajax({
                    url: '<?php echo e(route("api.keluar-parkir")); ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: { 
                        id_sensor: sensorId,
                        metode_pembayaran: metodePembayaran
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Show success step
                            $('#payment-step-5-process').hide();
                            $('#payment-step-6-success').show();
                            
                            // Build method display name
                            var methodDisplayName = getMethodName(selectedPaymentMethod);
                            if (selectedPaymentDetail) {
                                methodDisplayName += ' (' + selectedPaymentDetail + ')';
                            }
                            
                            // Fill success summary
                            var summary = '<div class="payment-summary-item">' +
                                '<span>Slot Parkir:</span>' +
                                '<span>' + $('#payment-slot-label').text() + '</span>' +
                                '</div>' +
                                '<div class="payment-summary-item">' +
                                '<span>Metode Pembayaran:</span>' +
                                '<span>' + methodDisplayName + '</span>' +
                                '</div>' +
                                '<div class="payment-summary-item">' +
                                '<span>Total Biaya:</span>' +
                                '<span>' + $('#payment-total').text() + '</span>' +
                                '</div>';
                            
                            if (selectedPaymentMethod === 'tunai') {
                                var cashAmount = parseFloat($('#payment-cash-amount').val());
                                var change = cashAmount - paymentTotal;
                                summary += '<div class="payment-summary-item">' +
                                    '<span>Jumlah Bayar:</span>' +
                                    '<span>Rp ' + cashAmount.toLocaleString('id-ID') + '</span>' +
                                    '</div>' +
                                    '<div class="payment-summary-item">' +
                                    '<span>Kembalian:</span>' +
                                    '<span>Rp ' + change.toLocaleString('id-ID') + '</span>' +
                                    '</div>';
                            }
                            
                            $('#payment-summary').html(summary);
                            $('#payment-success-message').text(response.message);
                            
                            // Hide warning
                            $('#durasi-warning').hide();
                            durasiWarningShown = false;
                            
                            // Hide exit button
                            $('.btn-keluar-user').hide();
                            userSlotId = null;
                            
                            // Refresh data
                            fetchData();
                        } else {
                            $('#payment-step-5-process').hide();
                            $('#payment-step-4-confirm').show();
                            showToast(response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#payment-step-5-process').hide();
                        $('#payment-step-4-confirm').show();
                        showToast('Terjadi kesalahan: ' + error, 'error');
                    }
                });
            }
            
            // Get method name
            function getMethodName(method) {
                var names = {
                    'tunai': 'Tunai',
                    'kartu_debit': 'Kartu Debit',
                    'kartu_kredit': 'Kartu Kredit',
                    'e_wallet': 'E-Wallet'
                };
                return names[method] || method;
            }
            
            // Close payment success
            $('#closePaymentSuccessBtn').on('click', function() {
                resetPaymentModal();
                paymentModal.css('display', 'none');
            });

            // Open modal when clicking on slot
            $('.slot').on('click', function() {
                // Check if user is logged in
                if (!currentUser) {
                    loginModal.css('display', 'block');
                    return;
                }
                
                var $slot = $(this);
                var sensorId = parseInt($slot.attr('data-sensor'));
                var slotLabel = $slot.find('.slot-label').text();
                var isOccupied = $slot.hasClass('occupied');

                if (!isOccupied) {
                    // Check if user already has a slot
                    if (userSlotId && userSlotId !== sensorId) {
                        var currentSlotLabel = $('.slot[data-sensor="' + userSlotId + '"]').find('.slot-label').text();
                        showToast('Anda sudah mengisi slot ' + currentSlotLabel + '. Silakan keluar dari slot tersebut terlebih dahulu.', 'warning');
                        return;
                    }
                    
                    // Empty slot - directly fill with user data
                    if (confirm('Apakah Anda ingin mengisi slot ' + slotLabel + '?')) {
                        fillSlot(sensorId, slotLabel);
                    }
                } else {
                    // Occupied slot - show info
                    var data = parkingData[sensorId];
                    if (data) {
                        $('#info-slot-label').text(slotLabel);
                        $('#info-nama').text(data.nama || '-');
                        $('#info-plat-nomor').text(data.plat_nomor || '-');
                        
                        // Format waktu masuk
                        if (data.waktu_masuk) {
                            var waktuMasukStr = data.waktu_masuk;
                            if (waktuMasukStr.indexOf('T') === -1 && waktuMasukStr.indexOf(' ') !== -1) {
                                waktuMasukStr = waktuMasukStr.replace(' ', 'T');
                            }
                            var waktuMasuk = new Date(waktuMasukStr);
                            
                            if (!isNaN(waktuMasuk.getTime())) {
                                var options = { 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    timeZone: 'Asia/Jakarta'
                                };
                                $('#info-waktu-masuk').text(waktuMasuk.toLocaleDateString('id-ID', options));
                            } else {
                                $('#info-waktu-masuk').text(data.waktu_masuk);
                            }
                        } else {
                            $('#info-waktu-masuk').text('-');
                        }
                        
                        infoModal.css('display', 'block');
                    }
                }
            });

            // Function to fill slot with current user data
            function fillSlot(sensorId, slotLabel) {
                var formData = {
                    id_sensor: sensorId,
                    nama: currentUser.nama,
                    plat_nomor: currentUser.plat_nomor
                };

                showLoading('Menyimpan data parkir...');

                $.ajax({
                    url: '<?php echo e(route("api.tambah-parkir")); ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            showToast(response.message, 'success');
                            userSlotId = sensorId;
                            // Show exit button immediately
                            $('.btn-keluar-user[data-sensor="' + sensorId + '"]').show();
                            fetchData();
                        } else {
                            showToast(response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        hideLoading();
                        showToast('Terjadi kesalahan: ' + error, 'error');
                    }
                });
            }

            function showLoginMessage(message, type) {
                var $message = $('#login-message');
                $message.html(message)
                    .removeClass('success error')
                    .addClass(type)
                    .fadeIn();
                
                if (type === 'error') {
                    setTimeout(function() {
                        $message.fadeOut();
                    }, 3000);
                }
            }

            // Close modal handlers
            closeBtn.on('click', function() {
                modal.css('display', 'none');
                selectedSlot = null;
                selectedSensorId = null;
            });

            closeInfoBtn.on('click', function() {
                infoModal.css('display', 'none');
            });

            cancelBtn.on('click', function() {
                modal.css('display', 'none');
                selectedSlot = null;
                selectedSensorId = null;
            });

            // Close modal when clicking outside (except login modal - must login)
            $(window).on('click', function(event) {
                if ($(event.target).is(modal)) {
                    modal.css('display', 'none');
                    selectedSlot = null;
                    selectedSensorId = null;
                }
                if ($(event.target).is(infoModal)) {
                    infoModal.css('display', 'none');
                }
                // Login modal cannot be closed by clicking outside
            });

            // Form submission
            $('#parkirForm').on('submit', function(e) {
                e.preventDefault();
                
                var formData = {
                    id_sensor: $('#selected-sensor').val(),
                    nama: $('#nama').val().trim(),
                    plat_nomor: $('#plat_nomor').val().trim().toUpperCase()
                };

                // Validate
                if (!formData.nama || !formData.plat_nomor) {
                    showMessage('Mohon lengkapi semua field!', 'error');
                    return;
                }
                
                // Validasi format plat nomor
                if (!validatePlatNomor(formData.plat_nomor)) {
                    showMessage('Format plat nomor tidak valid! Contoh: B 1234 XYZ atau AB 1234 CD', 'error');
                    return;
                }

                // Disable submit button
                $('.btn-submit').prop('disabled', true).text('Menyimpan...');
                showLoading('Menyimpan data parkir...');

                // Send data to server
                $.ajax({
                    url: '<?php echo e(route("api.tambah-parkir")); ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            showMessage(response.message, 'success');
                            showToast(response.message, 'success');
                            // Close modal after 1 second
                            setTimeout(function() {
                                modal.css('display', 'none');
                                $('#parkirForm')[0].reset();
                                selectedSlot = null;
                                selectedSensorId = null;
                                // Refresh data
                                fetchData();
                            }, 1000);
                        } else {
                            showMessage(response.message, 'error');
                            showToast(response.message, 'error');
                        }
                        $('.btn-submit').prop('disabled', false).text('Simpan');
                    },
                    error: function(xhr, status, error) {
                        hideLoading();
                        showMessage('Terjadi kesalahan: ' + error, 'error');
                        showToast('Terjadi kesalahan: ' + error, 'error');
                        $('.btn-submit').prop('disabled', false).text('Simpan');
                    }
                });
            });

            function showMessage(message, type) {
                var $message = $('#form-message');
                $message.html(message)
                    .removeClass('success error')
                    .addClass(type)
                    .fadeIn();
                
                if (type === 'success') {
                    setTimeout(function() {
                        $message.fadeOut();
                    }, 3000);
                }
            }

            // Initialize: load tarif, check login and start fetching data
            loadTarif();
            checkLogin();
            fetchData();

            function fetchData() {
                $.get("<?php echo e(route('api.kendaraan')); ?>", function (data) {
                    try {
                        // jQuery automatically parses JSON when Content-Type is application/json
                        var parsedData = typeof data === 'string' ? JSON.parse(data) : data;
                        var terisi = 0;
                        var total = 8;

                        // Create a map of sensor status and store full data
                        var sensorMap = {};
                        parkingData = {}; // Reset parking data
                        
                        for (var i = 0; i < parsedData.length; i++) {
                            var item = parsedData[i];
                            sensorMap[item.id_sensor] = item.status;
                            // Store full data for occupied slots
                            if (item.status == '1') {
                                parkingData[item.id_sensor] = {
                                    nama: item.nama || '',
                                    plat_nomor: item.plat_nomor || '',
                                    waktu_masuk: item.waktu_masuk || ''
                                };
                            }
                        }

                        // Reset all slots to empty (green)
                        $('.slot').each(function() {
                            var sensorId = parseInt($(this).attr('data-sensor'));
                            var status = sensorMap[sensorId];
                            
                            if (status == '1') {
                                // Occupied (red)
                                $(this).removeClass('empty').addClass('occupied');
                                terisi++;
                            } else {
                                // Empty (green) - default or status == '0'
                                $(this).removeClass('occupied').addClass('empty');
                            }
                        });

                        // Update summary
                        var kosong = total - terisi;
                        $('#terisi-slot').text(terisi);
                        $('#kosong-slot').text(kosong);
                        
                        // Check user slot after data update
                        if (currentUser) {
                            checkUserSlot();
                            // Check durasi parkir untuk warning
                            checkDurasiParkir();
                        }
                        
                        // Sound notification jika slot kosong bertambah (slot tersedia)
                        var previousKosong = parseInt($('#kosong-slot').data('previous') || kosong);
                        if (kosong > previousKosong && previousKosong > 0) {
                            playSound();
                            showToast('Slot parkir tersedia!', 'info', 3000);
                        }
                        $('#kosong-slot').data('previous', kosong);
                        
                    } catch (e) {
                        console.error('Error parsing data:', e);
                    }
                    
                    setTimeout(fetchData, 1000); // Refresh every 1 second
                }).fail(function() {
                    console.error('Error fetching data');
                    setTimeout(fetchData, 2000); // Retry after 2 seconds if error
                });
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\smartparking-main\resources\views/parkir/index.blade.php ENDPATH**/ ?>