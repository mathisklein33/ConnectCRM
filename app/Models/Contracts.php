<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contracts extends Model
{
    protected $fillable = [
        'client_id',
        'number',
        'title',
        'total',
        'content',
        'start_date',
        'end_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
