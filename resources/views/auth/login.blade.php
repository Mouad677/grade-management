<?php
use Illuminate\Support\Facades\Route;
?>
<x-guest-layout>
    <div class="text-center mb-4">
        <img src="{{ asset('images/images__1_-removebg-preview.png') }}" alt="Logo" style="width: 150px; height: 150px; object-fit: contain;">
        <h2 class="mt-3 mb-1 fw-bold text-primary">Connexion</h2>
        <p class="text-muted mb-4">Accédez à votre espace personnel</p>
    </div>
    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf
        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small text-primary" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" id="loginButton" style="background: linear-gradient(135deg, #FF6B35, #FF9F1C); border: none;">Se connecter</button>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('input', function() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const loginButton = document.getElementById('loginButton');
            
            if (email && password) {
                loginButton.style.background = 'linear-gradient(135deg, #2ECC71, #27AE60)';
            } else {
                loginButton.style.background = 'linear-gradient(135deg, #FF6B35, #FF9F1C)';
            }
        });
    </script>
</x-guest-layout>
