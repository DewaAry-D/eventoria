<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event'; // Tetap gunakan ini jika nama tabel di DB tunggal ('event' bukan 'events')
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class); 
    }

    public function organisasi()
    {
        return $this->belongsTo(OrganisasiMahasiswa::class, 'organisasi_id');
    }

    public function admin()
    {
        return $this->belongsTo(AdminKampus::class, 'admin_id');
    }

    public function timelines()
    {
        return $this->hasMany(TimeLine::class);
    }

    public function biayaEvents()
    {
        return $this->hasMany(BiayaEvent::class); 
    }

    public function templateSertifikat()
    {
        return $this->hasOne(TemplateSertifikat::class);
    }
}