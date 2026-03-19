<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaveFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'path',
        'mime_type',
        'size',
    ];
}
