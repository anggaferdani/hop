<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_and_beverages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat');
            $table->longText('deskripsi_tempat');
            $table->longText('lokasi');
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->enum('harga', ['< = Rp.50.000', 'Rp.50.000 - Rp.100.000', '> = Rp.100.000']);
            $table->enum('status_aktif', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_and_beverages');
    }
};
