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
        Schema::create('unit_alat_berats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit');
            $table->string('tipe')->nullable();
            $table->foreignId('lokasi_id')->constrained('lokasi_proyeks')->cascadeOnDelete();
            $table->string('status')->default('aktif');
            $table->timestamp('last_seen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_alat_berats');
    }
};
