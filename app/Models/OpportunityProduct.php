<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OpportunityProduct extends Pivot
{
    use HasFactory;
    /**
     * Indique si les IDs sont auto-incrémentés.
     * (Nécessaire si vous avez ajouté $table->id() dans votre migration pivot)
     */
    public $incrementing = true;

    /**
     * Nom de la table pivot associée.
     */
    protected $table = 'opportunity_product';

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'opportunity_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    /**
     * Calcul automatique du montant total pour cette ligne.
     * Très utile pour le Chef d'Équipe.
     */
    public function getTotalLineAttribute(): float
    {
        return $this->quantity * $this->unit_price;
    }

    /**
     * Relation inverse vers l'opportunité (Optionnel mais pratique)
     */
    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }

    /**
     * Relation inverse vers le produit
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
