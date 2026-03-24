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
// Utilisation dans le Controller
}
