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
        Schema::table('event', function (Blueprint $table) {
            $table->string('lokasi_url')->nullable()->change();
        });

        Schema::table('time_line', function (Blueprint $table) {
            $table->text('deskripsi_timeline')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('event', function (Blueprint $table) {
            $table->string('lokasi_url')->nullable(false)->change();
        });

        Schema::table('time_line', function (Blueprint $table) {
            $table->text('deskripsi_timeline')->nullable(false)->change();
        });
    }
};