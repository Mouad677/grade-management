<?php
use Illuminate\Support\Facades\Route;
?>
<x-guest-layout>
    <div class="text-center" style="margin-top: -2rem;">
        <img src="{{ asset('images/images__1_-removebg-preview.png') }}" alt="Logo" style="width: 150px; height: 150px; object-fit: contain;">
        <h2 class="mt-3 mb-1 fw-bold text-primary">Inscription</h2>
        <p class="text-muted mb-4">Créez votre compte</p>
    </div>

    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="text-decoration-none small text-primary" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" id="registerButton" style="background: linear-gradient(135deg, #FF6B35, #FF9F1C); border: none;">
            {{ __('Register') }}
        </button>
    </form>

    <script>
        document.getElementById('registerForm').addEventListener('input', function() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const registerButton = document.getElementById('registerButton');
            
            if (name && email && password && passwordConfirmation) {
                registerButton.style.background = 'linear-gradient(135deg, #2ECC71, #27AE60)';
            } else {
                registerButton.style.background = 'linear-gradient(135deg, #FF6B35, #FF9F1C)';
            }
        });
    </script>
</x-guest-layout>
