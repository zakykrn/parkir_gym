@extends('layouts.admin')

@section('title', 'Pengaturan - Admin')

@section('content')
<div class="admin-header">
    <h1>Pengaturan</h1>
    <p>Kelola pengaturan sistem</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Settings Form -->
<div class="admin-section">
    <h2>Pengaturan Tarif</h2>
    <form method="POST" action="{{ route('admin.settings') }}">
        @csrf
        <div class="form-group">
            <label for="tarif_per_jam">Tarif Parkir per Jam (Rp):</label>
            <input type="number" id="tarif_per_jam" name="tarif_per_jam" value="{{ $tarifPerJam }}" min="0" step="1000" required>
        </div>
        <button type="submit" class="btn-primary">Simpan Pengaturan</button>
    </form>
</div>
@endsection

