<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;

class CartController extends Controller
{
    public function add($id)
    {
        $produit = Produit::findOrFail($id); 
        $userId = Auth::id(); 


        $cartItem = Cart::where('produit_id', $id)->where('user_id', $userId)->first();
        if (!$cartItem) {
            
            Cart::create([
                'produit_id' => $id,
                'user_id' => $userId,
            ]);
        }

        
        return redirect('/')->with('success', 'Produit ajouté au panier avec succès');
    }


    public function cartpage()
    {
        $userId = Auth::id(); 

        
        $cartItems = Cart::where('user_id', $userId)->with('produit')->get();

        
        $total = $cartItems->sum(function ($item) {
            return $item->produit->prix;
        });

        
        return view('cart', [
            'cartItems' => $cartItems,
            'cartCount' => $cartItems->count(),
            'total' => $total
        ]);
    }

    public function delete($id)
    {
        $user = auth()->user(); 
        $cartItem = $user->carts()->findOrFail($id); 
        $cartItem->delete(); 

        return redirect()->route('cart')->with('success', 'Produit retiré du panier avec succès.');
    }
}
