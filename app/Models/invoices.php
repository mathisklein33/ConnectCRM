<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    protected $fillable = [
        'client_id',
        'number',
        'total',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
