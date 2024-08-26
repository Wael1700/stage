<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    // Nom de la table associé au modèle
    protected $table = 'produit';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'user_id',
        'name_produit',
        'prix',
        'photo',
        'lieu',
        'description',
    ];

    // Définir les relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
