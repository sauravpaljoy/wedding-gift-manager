<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = ['guest_id', 'type', 'amount', 'item_name', 'note'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
