<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeController;
use App\Models\Produit;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/test/{subyear}', TimeController::class);

Route::get('/', function () {
    $userId = auth()->id();
    $search = Request::input('search');

    // Récupérer les IDs des produits déjà dans le panier de l'utilisateur
    $produitsDansLePanier = Cart::where('user_id', $userId)->pluck('produit_id')->toArray();

    // Filtrer les produits pour exclure ceux qui sont déjà dans le panier, puis appliquer la recherche et la pagination
    $produits = Produit::when($search, function ($query, $search) {
        return $query->where('name_produit', 'like', "%{$search}%");
    })
    ->whereNotIn('id', $produitsDansLePanier) // Exclure les produits dans le panier
    ->paginate(20);

    // Récupérer le numéro de page actuel et le nombre total de pages pour la pagination
    $currentPage = $produits->currentPage();
    $totalPages = $produits->lastPage();

    // Compter le nombre total d'articles dans le panier de l'utilisateur
    $cartCount = Cart::where('user_id', $userId)->count();
    
    return view('welcome', [
        'produits' => $produits,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'search' => $search,
        'cartCount' => $cartCount
    ]);
})->name('produit');
Route::get('/create', function () {
    $user = Auth::user();
    $produits = Produit::where('user_id', $user->id)->get();
    $cartCount = Cart::where('user_id', $user->id)->count();
    return view('create_produit', [
        'produits' => $produits,
        'cartCount' => $cartCount,
    ]);
})->middleware(['auth', 'verified'])->name('aff_produit');

Route::post('/create', function () {

    $validatedData = Request::validate([
        'name_produit' => 'required|string|max:255',
        'prix' => 'required|numeric|min:0',
        'lieu' => 'required|string|max:255', // Ensure this validation exists
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'description' => 'required|string|max:500',
    ]);

    // Handle file upload
    $filePath = null;

    if (Request::hasFile('photo')) {
        $fileName = time().'_'.Request::file('photo')->getClientOriginalName();
        $filePath = Request::file('photo')->storeAs('uploads', $fileName, 'public');
    }

    Produit::create([
        'name_produit' => $validatedData['name_produit'],
        'prix' => $validatedData['prix'],
        'lieu' => $validatedData['lieu'],
        'photo' => $filePath,
        'user_id' => auth()->id(),
        'description' => $validatedData['description'],
    ]);

    // Redirect with a success message
    return redirect()->route('create_produit')->with('success', 'Product created successfully.');
})->name('create_produit');

Route::get('/product/{id}', function ($id) {
    $user = Auth::user();
    $produit = Produit::findOrFail($id);
    $cartCount = Cart::where('user_id', $user->id)->count();
    return view('aff_produit', [
        'produit' => $produit,
        'cartCount' => $cartCount
    ]);
})->middleware('auth')->name('aff_produit');
Route::delete('/produit/{id}', function ($id) {
    //kalb 3la produit dyal user connecte
    $user = auth()->user();
    $produit = $user->produits()->findOrFail($id);
    $produit->delete();

    return redirect()->route('create_produit')->with('success', 'Product deleted successfully');
})->middleware('auth')->name('delete_produit');
Route::post('/cart/add/{id}',function ($id) {
    $produit = Produit::findOrFail($id);
    $userId = auth()->id(); // Récupère l'ID de l'utilisateur connecté

    // Vérifie si le produit est déjà dans le panier pour cet utilisateur
    $cartItem = Cart::where('produit_id', $id)->where('user_id', $userId)->first();
        Cart::create([
            'produit_id' => $id,
            'user_id' => $userId,
        ]);
    
    return redirect('/')->with('success', 'Product deleted successfully');
})->middleware('auth')->name('add_cart');
Route::get('/cart', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté

    // Récupère les produits dans le panier de l'utilisateur
    $cartItems = Cart::where('user_id', $userId)->with('produit')->get();

    // Calculer le solde total
    $total = $cartItems->sum(function ($item) {
        return $item->produit->prix;
    });

    return view('cart', [
        'cartItems' => $cartItems,
        'cartCount' => $cartItems->count(),
        'total' => $total
    ]);
})->name('cart')->middleware('auth');
Route::delete('/cart/remove/{id}', function ($id) {
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();

    return redirect()->route('cart')->with('success', 'Produit retiré du panier avec succès.');
})->name('delete_cart')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
