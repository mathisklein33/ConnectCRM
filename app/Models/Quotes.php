<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $fillable = [
        'client_id',
        'number',
        'title',
        'total',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
