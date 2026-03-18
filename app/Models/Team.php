<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'user_id',
        'role',
    ];

    /**
     * Une team appartient à un user (créateur / chef)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Une team possède plusieurs clients
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
