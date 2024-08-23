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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="text-primary">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="input">
                @error('name')
                    <span class="text-error" style="margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="text-primary">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="input">
                @error('email')
                    <span class="text-error" style="margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone" class="text-primary">{{ __('Phone') }}</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel" class="input">
                @error('phone')
                    <span class="text-error" style="margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="text-primary">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="input">
                @error('password')
                    <span class="text-error" style="margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="text-primary">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input">
                @error('password_confirmation')
                    <span class="text-error" style="margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-footer">
                <a href="{{ route('login') }}" class="link">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="button">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>