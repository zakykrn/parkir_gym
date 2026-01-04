<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Setting;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    public function index()
    {
        try {
            return view('parkir.index');
        } catch (\Exception $e) {
            // Fallback jika view error
            return response()->json([
                'error' => 'View error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getKendaraan()
    {
        try {
            $kendaraan = Kendaraan::orderBy('id_sensor', 'asc')->get();
            return response()->json($kendaraan);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function tambahParkir(Request $request)
    {
        try {
            $request->validate([
                'id_sensor' => 'required|integer|min:1|max:20',
                'nama' => 'required|string|max:100',
                'plat_nomor' => 'required|string|max:20',
            ]);

            // Cek apakah slot sudah terisi
            $existing = Kendaraan::where('id_sensor', $request->id_sensor)
                ->where('status', 1)
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot parkir sudah terisi'
                ], 400);
            }

            // Update atau insert
            Kendaraan::updateOrCreate(
                ['id_sensor' => $request->id_sensor],
                [
                    'status' => 1,
                    'nama' => $request->nama,
                    'plat_nomor' => strtoupper($request->plat_nomor),
                    'waktu_masuk' => now(),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Data parkir berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function keluarParkir(Request $request)
    {
        try {
            $request->validate([
                'id_sensor' => 'required|integer|min:1|max:20',
                'metode_pembayaran' => 'nullable|string',
            ]);

            $kendaraan = Kendaraan::where('id_sensor', $request->id_sensor)
                ->where('status', 1)
                ->first();

            if (!$kendaraan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot parkir sudah kosong'
                ], 400);
            }

            // Hitung biaya
            $tarifPerJam = (float) Setting::getValue('tarif_per_jam', 5000);
            $waktuMasuk = new \DateTime($kendaraan->waktu_masuk);
            $waktuKeluar = new \DateTime();
            $durasiDetik = $waktuKeluar->getTimestamp() - $waktuMasuk->getTimestamp();
            $durasiJam = ceil($durasiDetik / 3600);
            if ($durasiJam < 1) $durasiJam = 1;
            $biaya = $durasiJam * $tarifPerJam;

            // Update
            $kendaraan->update([
                'status' => 0,
                'waktu_keluar' => now(),
                'biaya' => $biaya,
                'metode_pembayaran' => $request->metode_pembayaran ?? 'tunai',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Slot parkir berhasil dikosongkan',
                'biaya' => $biaya
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getTarif()
    {
        try {
            $tarif = (float) Setting::getValue('tarif_per_jam', 5000);
            return response()->json([
                'success' => true,
                'tarif_per_jam' => $tarif
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'tarif_per_jam' => 5000,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getRiwayat(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string',
                'plat_nomor' => 'required|string',
            ]);

            $riwayat = Kendaraan::where('nama', $request->nama)
                ->where('plat_nomor', $request->plat_nomor)
                ->whereNotNull('waktu_keluar')
                ->whereNotNull('biaya')
                ->orderBy('waktu_keluar', 'desc')
                ->limit(50)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'id_sensor' => $item->id_sensor,
                        'nama' => $item->nama,
                        'plat_nomor' => $item->plat_nomor,
                        'waktu_masuk' => $item->waktu_masuk,
                        'waktu_keluar' => $item->waktu_keluar,
                        'biaya' => $item->biaya,
                        'slot_label' => $item->slot_label,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $riwayat,
                'count' => $riwayat->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'idsensor' => 'required|integer|min:1|max:20',
                'status' => 'required|integer|in:0,1',
            ]);

            Kendaraan::where('id_sensor', $request->idsensor)
                ->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
