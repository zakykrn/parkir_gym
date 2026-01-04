<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kendaraan;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['showLogin', 'login']);
    }

    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Username atau password salah!']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalSlot = (int) Setting::getValue('total_slot', 20);
        $slotTerisi = Kendaraan::where('status', 1)->count();
        $slotKosong = $totalSlot - $slotTerisi;
        
        $transaksiHariIni = Kendaraan::whereDate('waktu_masuk', today())
            ->whereNotNull('waktu_keluar')
            ->count();
        
        $pendapatanHariIni = Kendaraan::whereDate('waktu_keluar', today())
            ->whereNotNull('biaya')
            ->sum('biaya') ?? 0;
        
        $pendapatanBulanIni = Kendaraan::whereMonth('waktu_keluar', now()->month)
            ->whereYear('waktu_keluar', now()->year)
            ->whereNotNull('biaya')
            ->sum('biaya') ?? 0;

        $parkirAktif = Kendaraan::where('status', 1)
            ->orderBy('waktu_masuk', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalSlot',
            'slotTerisi',
            'slotKosong',
            'transaksiHariIni',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'parkirAktif'
        ));
    }

    public function data(Request $request)
    {
        $query = Kendaraan::query();

        // Filter status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('waktu_masuk', $request->tanggal);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('plat_nomor', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('waktu_masuk', 'desc')->paginate(20);

        return view('admin.data', compact('data'));
    }

    public function settings()
    {
        $tarifPerJam = Setting::getValue('tarif_per_jam', 5000);
        return view('admin.settings', compact('tarifPerJam'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        Setting::setValue('tarif_per_jam', $request->tarif_per_jam, 'Tarif parkir per jam dalam Rupiah');

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}

