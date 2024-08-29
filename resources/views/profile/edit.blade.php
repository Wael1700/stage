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
            background-color: #f9f9f9;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #333;
            outline: none;
        }

        .btn-primary {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: darkred;
        }

        .card {
            padding: 1rem 2rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            width: 100%;
            max-width: 600px;
        }

        .card-content {
            max-width: 100%;
            margin: 0 auto;
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
.button-group {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Adds space between buttons */
    margin-top: 20px;
}

.btn-edit, .btn-delete {
    width: 100%;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-edit {
    background-color: green;
    color: white;
}

.btn-delete {
    background-color: red;
    color: white;
}

.btn-edit:hover {
    background-color: darkgreen;
}

.btn-delete:hover {
    background-color: darkred;
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
                        <span style="position: absolute; top: 0px; right: 0px; background-color: #007bff; color: white; padding: 2px 6px; border-radius: 50%; font-size: 12px;">{{ $cartCount }}</span>
                    </a>
                    <div class="dropdown">
                        <button class="nav-link">{{ Auth::user()->name }}</button>
                        <div class="dropdown-content">
                            <a href="/profile">{{ __('Profile') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a :href="route('logout')"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
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
        <div class="container">
            <header class="header">
                <h2>{{ __('Profile') }}</h2>
            </header>

            <div class="content">
                <div class="card">
                    <div class="card-content">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
