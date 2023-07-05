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
        Schema::create('update_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('update_id')->references('id')->on('updates')->onDelete('cascade');
            $table->foreignId('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('update_tags');
    }
};
