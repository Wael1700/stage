<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;

class ProduitController extends Controller
{
    public function contenu()
    {
        $user = Auth::user(); 
        $produits = Produit::where('user_id', $user->id)->get(); 
        $cartCount = Cart::where('user_id', $user->id)->count(); 
        return view('create_produit', [
            'produits' => $produits,
            'cartCount' => $cartCount,
        ]);
    }


    public function create(Request $request)
    {
       
        $validatedData = $request->validate([
            'name_produit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'lieu' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required|string|max:500',
        ]);

        $filePath = null; 

       
        if ($request->hasFile('photo')) {
            $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads', $fileName, 'public');
        }

       
        Produit::create([
            'name_produit' => $validatedData['name_produit'],
            'prix' => $validatedData['prix'],
            'lieu' => $validatedData['lieu'],
            'photo' => $filePath,
            'user_id' => auth()->id(),
            'description' => $validatedData['description'],
        ]);

        
        return redirect()->route('create_produit')->with('success', 'Produit créé avec succès.');
    }


    public function affichage($id)
    {
        $user = Auth::user(); 
        $produit = Produit::findOrFail($id); 
        $cartCount = Cart::where('user_id', $user->id)->count(); 
        return view('aff_produit', [
            'produit' => $produit,
            'cartCount' => $cartCount
        ]);
    }


    public function delete($id)
    {
        $user = auth()->user(); 
        $produit = $user->produits()->findOrFail($id); 
        $produit->delete();

       
        return redirect()->route('create_produit')->with('success', 'Produit supprimé avec succès');
    }

    public function edit($id)
    {
        $user = auth()->user(); 
        $produit = $user->produits()->findOrFail($id); 
        $cartCount = Cart::where('user_id', $user->id)->count(); 
        return view('edit_produit', [
            'produit' => $produit,
            'cartCount' => $cartCount
        ]);
    }


    public function update(Request $request, $id)
    {
    
        $validatedData = $request->validate([
            'name_produit' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'lieu' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user(); 
        $produit = $user->produits()->findOrFail($id); 

        
        $produit->name_produit = $validatedData['name_produit'];
        $produit->prix = $validatedData['prix'];
        $produit->lieu = $validatedData['lieu'];
        $produit->description = $validatedData['description'];

        
        if ($request->hasFile('photo')) {
            if ($produit->photo) {
                Storage::disk('public')->delete($produit->photo); 
            }
            $path = $request->file('photo')->store('photos', 'public'); 
            $produit->photo = $path;
        }

        
        $produit->save();

        
        return redirect()->route('edit_produit',['id' => $id])->with('success', 'Produit modifié avec succès !');
    }
}
