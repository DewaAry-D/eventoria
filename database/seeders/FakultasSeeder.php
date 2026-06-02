<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = [
            'Fakultas Teknik',
            'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            'Fakultas Kedokteran',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Ilmu Budaya',
            'Fakultas Hukum',
            'Fakultas Pertanian'
        ];

        foreach ($fakultas as $fak) {
            Fakultas::create(['nama_fakultas' => $fak]);
        }
    }
}