<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminKampus;
use App\Models\OrganisasiMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Kampus
        $adminUser = User::create([
            'email' => 'admin@unud.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        AdminKampus::create([
            'user_id' => $adminUser->id,
            'nama_admin' => 'Bapak Kepala Bidang Kemahasiswaan',
        ]);

        // 2. Akun Organisasi Mahasiswa
        $orgUser = User::create([
            'email' => 'sic@unud.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'organisasi',
        ]);
        OrganisasiMahasiswa::create([
            'user_id' => $orgUser->id,
            'nama_organisasi' => 'Student Innovation Centre (SIC)',
            'no_organisasi' => 'SIC-001',
            'fakultas_id' => 2,
            'prodi' => 'Informatika',
            'status' => 'aktif',
            'tingkat_organisasi' => 'fakultas',
        ]);

        // 3. Akun Mahasiswa
        $mhsUser = User::create([
            'email' => 'mhs.informatika@student.unud.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);
        Mahasiswa::create([
            'user_id' => $mhsUser->id,
            'nama' => 'Mahasiswa Teladan',
            'nim' => '2408561000',
            'prodi' => 'Informatika',
        ]);
    }
}