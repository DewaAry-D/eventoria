<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organisasi_mahasiswa', function (Blueprint $table) {
            $table->id("id"); 
            $table->foreignId('user_id')->constrained(table: 'users', column: 'id')->cascadeOnDelete();
            $table->string('nama_organisasi', 255);
            $table->string('no_organisasi', 50)->unique();
            $table->string('ig_url', 255)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->enum('status', ['pending', 'aktif', 'ditolak'])->default('pending');
            $table->enum('tingkat_organisasi', ['prodi', 'fakultas', 'universitas']);  
            $table->foreignId('fakultas_id')->nullable()->constrained('fakultas', 'id')->nullOnDelete();
            $table->string('prodi', 200)->nullable();
            $table->string('logo_url', 255)->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasi_mahasiswa');
    }
};