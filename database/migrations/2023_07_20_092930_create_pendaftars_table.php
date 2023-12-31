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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->foreignId('agenda_id')->references('id')->on('agendas')->onDelete('cascade');
            $table->string('nama_panjang');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('no_telepon');
            $table->string('email');
            $table->unsignedBigInteger('jenis_tiket_id')->nullable();
            $table->foreign('jenis_tiket_id')->references('id')->on('jenis_tikets');
            $table->string('bukti_transfer')->nullable();
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('pekerjaan')->nullable();
            $table->enum('status_aktif', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->enum('status_approved', ['Approved', 'Belum Di Approved'])->default('Belum Di Approved');
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
        Schema::dropIfExists('pendaftars');
    }
};
