<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function saveFiles()
    {
        return $this->hasMany(SaveFile::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withPivot('role') // Permet d'accéder à $user->pivot->role
            ->withTimestamps();
    }
    /**
     * Vérifie si l'utilisateur est admin (chef) d'une équipe spécifique
     */
    public function isAdminOfTeam($teamId)
    {
        return $this->teams()
            ->where('team_id', $teamId)
            ->wherePivot('role', 'manager')
            ->exists();
    }

// Méthode utilitaire pour vérifier le rôle
    // 1. La RELATION (pour récupérer l'objet Role)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

// 2. La VÉRIFICATION (pour tester le slug)
// On la nomme différemment, par exemple 'hasRole'
    public function hasRole($slug)
    {
        // On vérifie si l'utilisateur a un rôle et si son slug correspond
        return $this->role && $this->role->slug === $slug;
    }
}

