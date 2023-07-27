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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_and_beverage_id')->nullable();
            $table->foreign('food_and_beverage_id')->references('id')->on('food_and_beverages');
            $table->unsignedBigInteger('lodging_id')->nullable();
            $table->foreign('lodging_id')->references('id')->on('lodgings');
            $table->unsignedBigInteger('public_area_id')->nullable();
            $table->foreign('public_area_id')->references('id')->on('public_areas');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->enum('jenis', ['Online', 'Offline', 'Hybird']);
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->enum('tiket', ['Berbayar', 'Gratis'])->default('Berbayar');
            $table->string('tanggal_mulai');
            $table->string('tanggal_berakhir');
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
        Schema::dropIfExists('agendas');
    }
};
