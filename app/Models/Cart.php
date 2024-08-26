<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Nom de la table associé au modèle
    protected $table = 'cart';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'produit_id',
        'user_id'
    ];

    // Définir les relations
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
    
}
