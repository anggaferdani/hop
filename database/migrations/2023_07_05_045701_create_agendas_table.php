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
            $table->foreignId('hangout_place_id')->references('id')->on('hangout_places')->onDelete('cascade');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->enum('jenis', ['Online', 'Offline', 'Hybird']);
            $table->enum('tiket', ['Berbayar', 'Gratis']);
            $table->string('tanggal_mulai');
            $table->string('tanggal_berakhir');
            $table->enum('redirect_link_pendaftaran', ['Aktif', 'Tidak Aktif']);
            $table->string('link_pendaftaran')->nullable();
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
