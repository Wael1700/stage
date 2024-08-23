<x-guest-layout>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F5EFE6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .text-primary {
            color: #5a4335;
        }

        .text-error {
            color: #FF2D20;
        }

        .input {
            display: block;
            margin-top: 0.25rem;
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #5a4335;
            border-radius: 0.25rem;
            background-color: white;
        }

        .input:focus {
            border-color: #5a4335;
            outline: none;
            box-shadow: 0 0 0 2px rgba(90, 67, 53, 0.2);
        }

        .button {
            background-color: #5a4335;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #333;
        }

        .link {
            text-decoration: underline;
            color: #5a4335;
            font-size: 0.875rem;
            margin-right: 1rem;
            cursor: pointer;
        }

        .link:hover {
            color: #333;
        }

        .form-group {
            margin-top: 1rem;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .remember-me {
            margin-top: 1rem;
            display: flex;
            align-items: center;
        }

        .remember-me span {
            margin-left: 0.5rem;
            color: #5a4335;
        }

        .forgot-password {
            margin-left: auto;
            text-align: right;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="box">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" class="text-primary" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="input" />
                <x-input-error :messages="$errors->get('email')" class="text-error" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" class="text-primary" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="input" />
                <x-input-error :messages="$errors->get('password')" class="text-error" />
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-[#5a4335]" name="remember">
                    <span class="text-primary">{{ __('Remember me') }}</span>
                </label>
            </div>
            <a href="{{ route('register') }}" class="link forgot-password" >You don't have account ?</a>
            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a class="link forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="button ms-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>