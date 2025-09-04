<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduVote - Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <svg width="60" height="60" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 1rem;">
                    <path d="M4 16L20 8L36 16L20 24L4 16Z" fill="#3498db"/>
                    <path d="M28 18V28C28 28 24 32 20 32C16 32 12 28 12 28V18" stroke="#2c3e50" stroke-width="2"/>
                    <circle cx="20" cy="16" r="4" fill="#2c3e50"/>
                    <path d="M18 16L20 18L22 14" stroke="white" stroke-width="2"/>
                </svg>
                <h1>EduVote</h1>
                <p>Connectez-vous à votre espace</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="text-sm">{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                <div class="login-footer">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif

                    <button type="submit" class="login-button">
                        {{ __('Connexion') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>