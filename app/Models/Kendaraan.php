<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 't_kendaraan';

    protected $fillable = [
        'id_sensor',
        'status',
        'nama',
        'plat_nomor',
        'waktu_masuk',
        'waktu_keluar',
        'biaya',
        'metode_pembayaran',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
        'status' => 'integer',
        'biaya' => 'decimal:2',
    ];

    public function getSlotLabelAttribute()
    {
        if ($this->id_sensor <= 10) {
            return 'A' . $this->id_sensor;
        } else {
            return 'B' . ($this->id_sensor - 10);
        }
    }
}

