<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sensor');
            $table->integer('status')->default(0);
            $table->string('nama', 100)->nullable();
            $table->string('plat_nomor', 20)->nullable();
            $table->dateTime('waktu_masuk')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->decimal('biaya', 10, 2)->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kendaraan');
    }
};

