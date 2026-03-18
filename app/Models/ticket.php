<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'client_email',
        'client_telephone',
        'nom_ticket',
        'description',
        'date',
        'valide',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
