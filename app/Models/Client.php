<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'genre',
        'adresse',
        'ville',
        'code_postal',
        'entreprise',
        'telephone',
    ];
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

}
