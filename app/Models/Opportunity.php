<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'client_id',
        'user_id',
        'team_leader_id',
        'stage',
        'probability',
        'expected_closing_date'
    ];

    /**
     * Récupérer les produits liés à cette vente
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }

    // Calculer le montant total de l'opportunité
    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }
    // Dans Opportunity.php
    public function scopeForTeamLeader($query, $leaderId)
    {
        return $query->where('team_leader_id', $leaderId);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    // App\Models\Opportunity.php

    public function getExpectedValueAttribute()
    {
        $totalBrut = 0;

        // On boucle manuellement sur les produits pour être sûr de ne rien rater
        foreach ($this->products as $product) {
            $prix = (float) $product->pivot->unit_price;
            $quantite = (int) $product->pivot->quantity;

            $totalBrut += ($prix * $quantite);
        }

        // On applique la probabilité (ex: 80 / 100 = 0.8)
        $ratio = (float) ($this->probability / 100);

        return $totalBrut * $ratio;
    }

// Utilisation dans le Controller
}
