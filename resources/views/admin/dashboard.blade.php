@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sistem Parkir')

@section('content')
<div class="admin-header">
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ Auth::guard('admin')->user()->nama }}!</p>
</div>

<!-- Statistik Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #3498db;">
            <span>📊</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Slot</div>
            <div class="stat-value">{{ $totalSlot }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #e74c3c;">
            <span>🔴</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Slot Terisi</div>
            <div class="stat-value">{{ $slotTerisi }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #27ae60;">
            <span>🟢</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Slot Kosong</div>
            <div class="stat-value">{{ $slotKosong }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #f39c12;">
            <span>💰</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Pendapatan Hari Ini</div>
            <div class="stat-value">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #9b59b6;">
            <span>📈</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Pendapatan Bulan Ini</div>
            <div class="stat-value">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #1abc9c;">
            <span>🚗</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Transaksi Hari Ini</div>
            <div class="stat-value">{{ $transaksiHariIni }}</div>
        </div>
    </div>
</div>

<!-- Parkir Aktif -->
<div class="admin-section">
    <div class="section-header">
        <h2>Parkir Aktif Saat Ini</h2>
        <a href="{{ route('admin.data') }}" class="btn-link">Lihat Semua Data →</a>
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
                @forelse($parkirAktif as $parkir)
                    @php
                        $waktuMasuk = \Carbon\Carbon::parse($parkir->waktu_masuk);
                        $durasi = $waktuMasuk->diffForHumans();
                    @endphp
                    <tr>
                        <td>{{ $parkir->id_sensor }}</td>
                        <td><strong>{{ $parkir->slot_label }}</strong></td>
                        <td>{{ $parkir->nama }}</td>
                        <td>{{ $parkir->plat_nomor }}</td>
                        <td>{{ $waktuMasuk->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $durasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada parkir aktif saat ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="admin-section">
    <h2>Quick Actions</h2>
    <div class="quick-actions">
        <a href="{{ route('admin.data') }}" class="action-btn">
            <span class="action-icon">📋</span>
            <span class="action-text">Lihat Semua Data</span>
        </a>
        <a href="{{ route('admin.settings') }}" class="action-btn">
            <span class="action-icon">⚙️</span>
            <span class="action-text">Pengaturan</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="action-btn">
            <span class="action-icon">👁️</span>
            <span class="action-text">Lihat Website</span>
        </a>
    </div>
</div>
@endsection

