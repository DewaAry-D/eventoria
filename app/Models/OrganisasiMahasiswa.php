<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganisasiMahasiswa extends Model
{
    protected $table = 'organisasi_mahasiswa';
    
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}