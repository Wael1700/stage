<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduit extends Pivot
{
    protected $table = 'cart_produit';
    protected $fillable = ['cart_id', 'produit_id'];
}
