<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi sekarang otomatis mencari kolom 'user_id' di tabel target
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function organisasi()
    {
        return $this->hasOne(OrganisasiMahasiswa::class);
    }

    public function adminKampus()
    {
        return $this->hasOne(AdminKampus::class);
    }
}