<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sku',
        'categorie',
        'price',
        'is_active',
        'quantity',
        'unit_price',
        'created_at',
        'updated_at',
    ];

    /**
     * Cast des attributs pour garantir les types de données.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active'  => 'boolean',
    ];

    /**
     * Relation avec les Opportunités (Cycle de vente).
     * Un produit peut être présent dans plusieurs opportunités.
     */
    public function opportunities(): BelongsToMany
    {
        return $this->belongsToMany(Opportunity::class)
            ->withPivot(['quantity', 'unit_price', 'discount'])
            ->withTimestamps();
    }

    /**
     * Scope pour filtrer uniquement les produits activés dans le catalogue.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor pour calculer la marge théorique sur le produit.
     * Utile pour les rapports du chef d'équipe.
     */
    public function getPotentialMarginAttribute(): float
    {
        return (float) $this->base_price - (float) $this->cost_price;
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
