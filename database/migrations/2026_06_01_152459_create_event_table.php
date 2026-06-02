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
        Schema::create('event', function (Blueprint $table) {
            $table->id('id'); 
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('admin_acc_id')->nullable(); 
            $table->unsignedBigInteger('organisasi_id');
            $table->string('nama_event', 255);
            $table->string('slug', 255)->unique();
            $table->string('penyelenggara', 255);
            $table->enum('status', ['diterima', 'ditolak', 'pending']); 
            $table->text('deskripsi');
            $table->string('nama_lokasi', 255);
            $table->string('lokasi_url', 255);
            $table->integer('kuota');
            $table->integer('sisa_kuota');
            $table->text('narasumber');
            $table->string('link_event', 255);
            $table->string('pesan_ditolak', 255)->nullable();
            $table->string('flyer_url', 255);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('admin_acc_id')->references('id')->on('admin_kampus');
            $table->foreign('organisasi_id')->references('id')->on('organisasi_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
