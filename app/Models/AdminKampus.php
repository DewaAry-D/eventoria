<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminKampus extends Model
{
    protected $table = 'admin_kampus';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}