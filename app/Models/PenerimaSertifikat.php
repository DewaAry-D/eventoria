<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaSertifikat extends Model
{
    protected $table = 'penerima_sertifikat';
    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
