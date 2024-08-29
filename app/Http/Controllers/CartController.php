<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;

class CartController extends Controller
{
    public function create($id)
    {
        $produit = Produit::findOrFail($id); 
        $userId = Auth::id(); 

        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ]);
        $cartItem = $cart->produits()->where('produit_id', $id)->first();
        if (!$cartItem) {
            
            $cart->produits()->attach($id);
        }

        
        return redirect('/')->with('success', 'Produit ajouté au panier avec succès');
    }


    public function store()
    {
        $userId = Auth::id(); 

  
        $cart = Cart::where('user_id', $userId)->first();

        
        $cartItems = $cart->produits()->get();

        
        $total = $cartItems->sum('prix');

        
        return view('cart', [
            'cartItems' => $cartItems,
            'cartCount' => $cartItems->count(),
            'total' => $total
        ]);
    }
    
    public function destroy($id)
    {
        $user = auth()->user(); 
        $cart = Cart::where('user_id', $user->id)->first();
        $cart->produits()->detach($id);
         

        return redirect()->route('cart')->with('success', 'Produit retiré du panier avec succès.');
    }
}
