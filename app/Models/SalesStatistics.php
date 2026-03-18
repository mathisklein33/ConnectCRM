<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'sales_count',
        'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
