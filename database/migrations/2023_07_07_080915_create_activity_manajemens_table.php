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
        Schema::create('activity_manajemens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->date('tanggal_publikasi');
            $table->longText('lokasi');
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('harga_mulai')->nullable();
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
        Schema::dropIfExists('activity_manajemens');
    }
};
