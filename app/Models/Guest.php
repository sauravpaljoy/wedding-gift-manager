<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['event_id', 'name', 'phone', 'address', 'relation'];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function gifts()
    {
        return $this->hasMany(Gift::class);
    }
}

