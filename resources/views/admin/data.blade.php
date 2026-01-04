@extends('layouts.admin')

@section('title', 'Data Parkir - Admin')

@section('content')
<div class="admin-header">
    <h1>Data Parkir</h1>
    <p>Kelola dan lihat semua data parkir</p>
</div>

<!-- Statistics Summary -->
<div class="stats-grid" style="margin-bottom: 30px;">
    <div class="stat-card">
        <div class="stat-icon" style="background: #3498db;">
            <span>📋</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Data</div>
            <div class="stat-value">{{ $data->total() }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #e74c3c;">
            <span>🔴</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Terisi</div>
            <div class="stat-value">{{ $data->where('status', 1)->count() }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #27ae60;">
            <span>🟢</span>
        </div>
        <div class="stat-content">
            <div class="stat-label">Kosong</div>
            <div class="stat-value">{{ $data->where('status', 0)->count() }}</div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="admin-section">
    <form method="GET" action="{{ route('admin.data') }}" class="filter-form">
        <div class="filter-group">
            <label>Status:</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Terisi</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Kosong</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}">
        </div>
        <div class="filter-group">
            <label>Pencarian:</label>
            <input type="text" name="search" placeholder="Nama atau Plat Nomor" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-primary">Filter</button>
        <a href="{{ route('admin.data') }}" class="btn-secondary">Reset</a>
    </form>
</div>

<!-- Data Table -->
<div class="admin-section">
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Slot</th>
                    <th>Nama</th>
                    <th>Plat Nomor</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><strong>{{ $item->slot_label }}</strong></td>
                        <td>{{ $item->nama ?? '-' }}</td>
                        <td>{{ $item->plat_nomor ?? '-' }}</td>
                        <td>{{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $item->waktu_keluar ? \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $item->biaya ? 'Rp ' . number_format($item->biaya, 0, ',', '.') : '-' }}</td>
                        <td>
                            @if($item->status == 1)
                                <span class="badge badge-danger">Terisi</span>
                            @else
                                <span class="badge badge-success">Kosong</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
        {{ $data->links() }}
    </div>
</div>
@endsection

