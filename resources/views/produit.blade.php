<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PRODUIT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="container">
        <h1>Recherche de Produits</h1>

       
        <form action="{{ route('produit') }}" method="GET">
            @csrf
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nom du produit">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

    
        @if($produits->isEmpty())
            <p>Aucun produit trouvé.</p>
        @else
            <ul>
                @foreach($produits as $produit)
                    <li>
                    <strong style="color:green;">{{ $produit->user->name }}</strong> -<strong>{{ $produit->name_produit }}</strong> - {{ $produit->prix }}€
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
