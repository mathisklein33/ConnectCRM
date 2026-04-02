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


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
