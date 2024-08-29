<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('produit');

Route::get('/create', [ProduitController::class, 'store'])->middleware(['auth', 'verified'])->name('aff_produit');
Route::post('/create', [ProduitController::class, 'create'])->name('create_produit');
Route::get('/product/{id}', [ProduitController::class, 'show'])->middleware('auth')->name('aff_produit');
Route::delete('/product/{id}', [ProduitController::class, 'destroy'])->middleware('auth')->name('delete_produit');
Route::get('/products/{id}/', [ProduitController::class, 'edit'])->middleware('auth')->name('edit_produit');
Route::post('/products/{id}/edit', [ProduitController::class, 'update'])->middleware('auth')->name('update_produit');


Route::middleware('auth')->group(function () {
Route::post('/cart/add/{id}', [CartController::class, 'create'])->middleware('auth')->name('add_cart');
Route::get('/cart', [CartController::class, 'store'])->middleware('auth')->name('cart');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->middleware('auth')->name('delete_cart');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
