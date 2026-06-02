<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; 
    
    protected $guarded = ['id'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}