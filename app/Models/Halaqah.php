<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaqah extends Model
{
    protected $table = 'halaqah';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function murobbi()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
