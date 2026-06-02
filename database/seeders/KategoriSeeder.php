<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Seminar',
            'Workshop',
            'Bootcamp',
            'Lomba / Kompetisi',
            'Sosialisasi',
            'Tech Talk',
            'Kepanitiaan'
        ];

        foreach ($kategori as $kat) {
            Kategori::create(['nama_kategori' => $kat]);
        }
    }
}