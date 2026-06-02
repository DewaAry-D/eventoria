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
        Schema::create('template_sertifikat', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('event_id');
            $table->string('file_template', 255);
            $table->integer('posisi_x');
            $table->integer('posisi_y');
            $table->string('jenis_font', 100);
            $table->integer('ukuran_font'); 
            $table->string('warna_font', 10);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_sertifikat');
    }
};
