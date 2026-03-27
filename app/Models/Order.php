<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quotes;
use App\Models\Client;

class Order extends Model
{
    protected $fillable = [
        'quote_id',
        'client_id',
        'number',
        'total',
    ];

    public function quote()
    {
        return $this->belongsTo(Quotes::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
