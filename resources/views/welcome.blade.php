<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ILY Express') }}</title>
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F5EFE6;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        }

        .logo h1 {
            margin: 0;
            font-size: 24px;
            color: #5a4335;
        }

        .nav {
            display: flex;
            gap: 15px;
        }

        .nav-link {
            text-decoration: none;
            color: #5a4335;
            font-size: 16px;
            padding: 10px 20px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #333;
            border-color: #5a4335;
        }

        .content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .search-container {
            margin-top: 20px;
            width: 100%;
            max-width: 600px;
            display: flex;
            justify-content: center;
        }

        .form-control {
            width: 80%;
            padding: 10px;
            border: 1px solid #5a4335;
            border-radius: 0.25rem;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #5a4335;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 40px;
            width: 100%;
            max-width: 1200px;
        }

        .product-item {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            padding: 15px;
            text-align: center;
        }

        .product-item img {
            max-width: 100%;
            border-radius: 0.25rem;
            margin-bottom: 15px;
        }

        .product-item h3 {
            margin: 0;
            font-size: 18px;
            color: #5a4335;
        }

        .product-item p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }

        .product-item .price {
            font-size: 20px;
            color: green;
            font-weight: bold;
        }
        .product-link {
    text-decoration: none; /* Remove underline */
}

.product-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-item:hover {
    transform: scale(1.05); /* Slight zoom effect */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a shadow */
}
.cart-link {
            text-decoration: none;
            color: #5a4335;
            font-size: 16px;
            padding: 10px 20px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
.cart-link {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.cart-link :hover {
    transform: scale(1.05); /* Slight zoom effect */
}
        .dropbtn {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
        


.dropdown {
    position: relative;
    display: inline-block;
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}


.dropdown-content a:hover {background-color: #f1f1f1}


.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.pagination-links {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    gap: 5px;
}

.page-item {
    display: inline-block;
}

.page-link {
    color: #5a4335; /* Couleur du texte */
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    border: 1px solid #5a4335; /* Couleur de la bordure */
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-link:hover {
    background-color: #5a4335; /* Couleur de fond au survol */
    color: white; /* Couleur du texte au survol */
}

.page-item.active .page-link {
    background-color: #5a4335; /* Couleur de fond de la page active */
    color: white; /* Couleur du texte de la page active */
    border-color: #5a4335; /* Couleur de la bordure de la page active */
    font-weight: bold;
}

.page-item.disabled .page-link {
    color: #ccc;
    pointer-events: none;
    border-color: #ccc;
}

    </style>
</head>
<body>
<header class="header">
    <div class="logo">
        <h1>ILY EXPRESS</h1>
    </div>
    @if (Route::has('login'))
        <nav class="nav">
            @auth 
                <a href="{{ url('/') }}" class="nav-link">Produit</a>
                <a href="{{ url('/create') }}" class="nav-link">Create</a>
                <a href="{{ url('/cart') }}" class="cart-link" style="position: relative; display: inline-block;">
    <img src="{{ asset('images/chariot.png') }}" alt="Chariot" style="width: 24px; height: 24px;">
    <span style="
        position: absolute;
        top: 0px;
        right: 0px;
        background-color: #007bff;
        color: white;
        padding: 2px 6px;
        border-radius: 50%;
        font-size: 12px;
    ">
        {{ $cartCount }}
    </span>
</a>

                <div class="dropdown">
                <button class="nav-link">{{ Auth::user()->name }}</button>
                 <div class="dropdown-content">
                 <a href="/profile">{{ __('Profile') }}</a>
                 <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                
                </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            @endauth
        </nav>
    @endif
</header>

    <div class="content">
    
        <div class="search-container">
            <form action="{{ route('produit') }}" method="GET" style="display: flex; width: 100%;">
                @csrf
                <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nom du produit">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>

       
        <div class="product-grid">
    @foreach($produits as $produit) 
        @auth
            
            <a href="{{ url('/product/' . $produit->id) }}" class="product-link">
        @else
            
            <a href="{{ route('login') }}" class="product-link">
        @endauth
            <div class="product-item">
                <div style="width: 200px; height: 300px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->name_produit }}" style="max-width: 100%; max-height: 100%;">
                </div>
                <h3>{{ $produit->name_produit }}</h3>
                <p>Vendu d'ou: <strong style="color:green;">{{ $produit->lieu }}</strong></p>
                <p class="price">{{ $produit->prix }}DH</p>
            </div>
        </a>
    @endforeach
</div>
<div class="pagination-links">
    <ul class="pagination">
        {{-- Lien vers la page précédente --}}
        @if($produits->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $produits->previousPageUrl() }}">« Previous</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">« Previous</span>
            </li>
        @endif

        {{-- Boucle pour générer les numéros de pages --}}
        @for ($page = 1; $page <= $produits->lastPage(); $page++)
            <li class="page-item {{ $page == $produits->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $produits->url($page) }}">{{ $page }}</a>
            </li>
        @endfor

        {{-- Lien vers la page suivante --}}
        @if($produits->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $produits->nextPageUrl() }}">Next »</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next »</span>
            </li>
        @endif
    </ul>
</div>
    </div>
</body>
</html>
