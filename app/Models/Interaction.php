<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
class Interaction extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'type', 'date', 'sujet', 'contenu', 'statut'];

    protected $casts = [
        'date' => 'datetime',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
