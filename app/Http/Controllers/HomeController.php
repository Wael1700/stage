<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;

class HomeController extends Controller
{ 
    public function index(Request $request)
    {
        $userId = Auth::id(); 

        $search = $request->input('search'); 
        $cartCount=0;
        if($userId){
        $cart = Cart::where('user_id', $userId)->first();

        
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();
        }

        
        $produitsDansLePanier = $cart->produits()->pluck('produit_id')->toArray();

        $produits = Produit::when($search, function ($query, $search) {
            return $query->where('name_produit', 'like', "%{$search}%");
        })
        ->whereNotIn('id', $produitsDansLePanier)
        ->paginate(20);

    
        $cartCount = $cart->produits()->count();
}
$produits = Produit::when($search, function ($query, $search) {
    return $query->where('name_produit', 'like', "%{$search}%");
})
->paginate(20);
        return view('welcome', [
            'produits' => $produits,
            'search' => $search,
            'cartCount' => $cartCount
        ]);
    }
}
