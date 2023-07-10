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
        Schema::create('activity_manajemen_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_manajemen_id')->references('id')->on('activity_manajemens')->onDelete('cascade');
            $table->foreignId('type_id')->references('id')->on('types')->onDelete('cascade');
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
        Schema::dropIfExists('activity_manajemen_types');
    }
};
