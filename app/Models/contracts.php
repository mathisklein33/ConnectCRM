<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class contracts extends Model
{
    use HasFactory;
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
