<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_schedules extends Model {
  use HasFactory;

    // Si ta table s'appelle "events", Laravel la trouve tout seul.
    // Sinon, décommente la ligne suivante :
    protected $table = 'work_schedules';

    // On autorise le remplissage de ces colonnes (Mass Assignment)
    protected $fillable = [
    'title',
    'description',
    'date',
    'start_time',
    'end_time',
    'team_id',
    'user_id',
];

    // Optionnel : Si tu veux que Laravel traite tes colonnes comme des objets Carbon (dates)
    protected $casts = [
    'date' => 'date',
];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
