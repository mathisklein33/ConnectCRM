<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'email',
        'sujet',
        'message',
        'statut'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
