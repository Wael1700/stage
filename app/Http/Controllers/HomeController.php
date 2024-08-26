<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;

class HomeController extends Controller
{
    public function Home(Request $request)
    {
        $userId = Auth::id();
        $search = $request->input('search');

        $produitsDansLePanier = Cart::where('user_id', $userId)->pluck('produit_id')->toArray();

        $produits = Produit::when($search, function ($query, $search) {
            return $query->where('name_produit', 'like', "%{$search}%");
        })
        ->whereNotIn('id', $produitsDansLePanier) 
        ->paginate(20);

        $cartCount = Cart::where('user_id', $userId)->count();
        
        return view('welcome', [
            'produits' => $produits,
            'search' => $search,
            'cartCount' => $cartCount
        ]);
    }
}
