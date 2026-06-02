<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaEvent extends Model
{
    protected $table = 'biaya_event';
    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
