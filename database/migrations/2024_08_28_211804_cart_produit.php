<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_produit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('cart')->onDelete('cascade'); 
            $table->foreignId('produit_id')->constrained('produit')->onDelete('cascade');  // Pour lier le panier à un utilisateur spécifique
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
