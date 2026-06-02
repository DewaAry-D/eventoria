<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSertifikat extends Model
{
    protected $table = 'template_sertifikat';
    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
