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

        .form-container {
            margin-top: 20px;
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 0.25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #5a4335;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #5a4335;
            border-radius: 0.25rem;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-primary {
            background-color: #5a4335;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown content (hidden by default) */
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

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
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
                <!-- Simple Profile Dropdown using <a> and CSS -->
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

<div class="product-detail-container" style="display: flex; align-items: flex-start; padding: 40px; gap: 40px; max-width: 1200px; margin: auto; background-color: #fff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); border-radius: 12px;">
    
    <!-- Section de la photo du produit -->
    <div class="product-image" style="flex: 1;">
        <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->name_produit }}" style="width: 100%; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    </div>
    
    <!-- Section des détails du produit -->
    <div class="product-info" style="flex: 2; padding: 20px;">
        <h1 style="font-size: 32px; color: #333; font-weight: bold;">{{ $produit->name_produit }}</h1>
        <p style="font-size: 18px; color: #666; line-height: 1.6; margin-top: 20px;">{{ $produit->description }}</p>
        
        <div style="margin-top: 30px;">
            <span style="font-size: 26px; color: #27ae60; font-weight: bold;">{{ $produit->prix }}DH</span>
        </div>
        
        <!-- Détails du propriétaire -->
        <div class="product-owner" style="margin-top: 40px; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 22px; color: #333; font-weight: bold;">Vendu par</h3>
            <p style="font-size: 18px; color: #555; margin-top: 10px;"><strong>Nom :</strong> {{ $produit->user->name }}</p>
            <p style="font-size: 18px; color: #555; margin-top: 5px;"><strong>Contact :</strong> {{ $produit->user->phone }}</p>
        </div>
        @auth
    @if($produit->user_id !== auth()->id())
        <form action="{{ route('add_cart', $produit->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn-primary">ADD to Cart</button>
        </form>
    @else
        <p>Vous êtes le propriétaire de ce produit.</p>
    @endif
@endauth
    </div>
</div>
</body>
</html>