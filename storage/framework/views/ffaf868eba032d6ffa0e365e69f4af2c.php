

<?php $__env->startSection('title', 'Dashboard Admin - Sistem Parkir'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>Dashboard</h1>
    <p>Selamat datang, <?php echo e(Auth::guard('admin')->user()->nama); ?>!</p>
</div>

<!-- Statistik Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #3498db;">
            <span>📊</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Slot</div>
            <div class="stat-value"><?php echo e($totalSlot); ?></div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #e74c3c;">
            <span>🔴</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Slot Terisi</div>
            <div class="stat-value"><?php echo e($slotTerisi); ?></div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #27ae60;">
            <span>🟢</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Slot Kosong</div>
            <div class="stat-value"><?php echo e($slotKosong); ?></div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #f39c12;">
            <span>💰</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Pendapatan Hari Ini</div>
            <div class="stat-value">Rp <?php echo e(number_format($pendapatanHariIni, 0, ',', '.')); ?></div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #9b59b6;">
            <span>📈</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Pendapatan Bulan Ini</div>
            <div class="stat-value">Rp <?php echo e(number_format($pendapatanBulanIni, 0, ',', '.')); ?></div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #1abc9c;">
            <span>🚗</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Transaksi Hari Ini</div>
            <div class="stat-value"><?php echo e($transaksiHariIni); ?></div>
        </div>
    </div>
</div>

<!-- Parkir Aktif -->
<div class="admin-section">
    <div class="section-header">
        <h2>Parkir Aktif Saat Ini</h2>
        <a href="<?php echo e(route('admin.data')); ?>" class="btn-link">Lihat Semua Data →</a>
    </div>
    
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID Sensor</th>
                    <th>Slot</th>
                    <th>Nama</th>
                    <th>Plat Nomor</th>
                    <th>Waktu Masuk</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $parkirAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parkir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $waktuMasuk = \Carbon\Carbon::parse($parkir->waktu_masuk);
                        $durasi = $waktuMasuk->diffForHumans();
                    ?>
                    <tr>
                        <td><?php echo e($parkir->id_sensor); ?></td>
                        <td><strong><?php echo e($parkir->slot_label); ?></strong></td>
                        <td><?php echo e($parkir->nama); ?></td>
                        <td><?php echo e($parkir->plat_nomor); ?></td>
                        <td><?php echo e($waktuMasuk->format('d/m/Y H:i:s')); ?></td>
                        <td><?php echo e($durasi); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada parkir aktif saat ini</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="admin-section">
    <h2>Quick Actions</h2>
    <div class="quick-actions">
        <a href="<?php echo e(route('admin.data')); ?>" class="action-btn">
            <span class="action-icon">📋</span>
            <span class="action-text">Lihat Semua Data</span>
        </a>
        <a href="<?php echo e(route('admin.settings')); ?>" class="action-btn">
            <span class="action-icon">⚙️</span>
            <span class="action-text">Pengaturan</span>
        </a>
        <a href="<?php echo e(route('home')); ?>" target="_blank" class="action-btn">
            <span class="action-icon">👁️</span>
            <span class="action-text">Lihat Website</span>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\smartparking-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>