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
    </style>

    <div class="box">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" class="text-primary" />
                <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="text-error" />
            </div>

            <div class="form-footer">
                <button type="submit" class="button">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
