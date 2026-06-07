<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organisasi_mahasiswa', function (Blueprint $table) {
            $table->text('pesan_penolakan')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('organisasi_mahasiswa', function (Blueprint $table) {
            $table->dropColumn('pesan_penolakan');
        });
    }
};