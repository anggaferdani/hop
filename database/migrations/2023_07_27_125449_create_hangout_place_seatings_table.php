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
        Schema::create('hangout_place_seatings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hangout_place_id')->references('id')->on('hangout_places')->onDelete('cascade');
            $table->foreignId('seating_id')->references('id')->on('seatings')->onDelete('cascade');
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
        Schema::dropIfExists('hangout_place_seatings');
    }
};
