@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            :root {
                --primary-color: #FF6B35;  /* Orange vif */
                --secondary-color: #2ECC71;  /* Vert émeraude */
                --accent-color: #FF9F1C;  /* Orange doré */
                --text-color: #2C3E50;  /* Bleu foncé pour le texte */
                --light-bg: #F8F9FA;  /* Fond clair */
                --dark-bg: #2C3E50;  /* Fond sombre */
            }

            body {
                font-family: 'Poppins', sans-serif;
                color: var(--text-color);
                background-color: var(--light-bg);
            }

            .navbar {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
                padding: 0.5rem 0;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                height: 70px;
                display: flex;
                align-items: center;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: white !important;
                text-transform: uppercase;
                letter-spacing: 1px;
                display: flex;
                align-items: center;
                height: 100%;
                margin-right: 0;
            }

            .navbar-brand img {
                max-height: 50px;
                width: auto;
                object-fit: contain;
                margin-left: 0;
            }

            .nav-link {
                font-weight: 500;
                color: rgba(255,255,255,0.9) !important;
                padding: 0.5rem 1rem !important;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                color: white !important;
                transform: translateY(-2px);
            }

            .nav-link i {
                margin-right: 0.5rem;
            }

            .dropdown-menu {
                border: none;
                border-radius: 0.5rem;
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
                padding: 0.5rem;
            }

            .dropdown-item {
                padding: 0.75rem 1rem;
                border-radius: 0.375rem;
                transition: all 0.3s ease;
            }

            .dropdown-item:hover {
                background-color: rgba(255, 107, 53, 0.1);
            }

            .dropdown-item i {
                margin-right: 0.5rem;
                color: var(--primary-color);
            }

            .card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 1rem 2rem rgba(0,0,0,0.15);
            }

            .btn {
                border-radius: 0.5rem;
                padding: 0.5rem 1.5rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
                border: none;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
                transform: translateY(-2px);
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            }

            .btn-danger {
                background: linear-gradient(135deg, #FF6B35, #FF9F1C);
                border: none;
            }

            .btn-danger:hover {
                transform: translateY(-2px);
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            }

            .table {
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
            }

            .table thead {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
            }

            .table th {
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                padding: 1rem;
            }

            .table td {
                padding: 1rem;
                vertical-align: middle;
            }

            .form-control {
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                border: 2px solid #e9ecef;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            }

            .alert {
                border-radius: 0.5rem;
                border: none;
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
            }

            main {
                padding: 2rem 0;
            }

            .container {
                max-width: 1200px;
                padding: 0 1.5rem;
            }

            .navbar .container {
                padding-left: 0.5rem;
            }

            @media (max-width: 768px) {
                .navbar-brand {
                    font-size: 1.2rem;
                }

                .nav-link {
                    padding: 0.5rem !important;
                }

                .card {
                    margin-bottom: 1rem;
                }
            }

            .home-btn {
                color: white !important;
                font-weight: 500;
                padding: 0.5rem 1rem !important;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                margin-left: 1rem;
            }

            .home-btn:hover {
                background-color: rgba(255, 255, 255, 0.1);
                transform: translateY(-2px);
            }

            .home-btn i {
                margin-right: 0.5rem;
            }

            .feature-icon {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            }

            .step-number {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            }

            .cta-section {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/images__1_-removebg-preview.png') }}" alt="Logo" class="me-2">
                    </a>
                    <a href="{{ url('/') }}" class="nav-link home-btn">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            @auth
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'assistant')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->role === 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                                            <i class="fas fa-users"></i> Utilisateurs
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.grades.index') }}">
                                            <i class="fas fa-graduation-cap"></i> Notes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.logs.index') }}">
                                            <i class="fas fa-history"></i> Logs
                                        </a>
                                    </li>
                                @elseif(Auth::user()->role === 'assistant')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.grades.index') }}">
                                            <i class="fas fa-graduation-cap"></i> Notes
                                        </a>
                                    </li>
                                @elseif(Auth::user()->role === 'student')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('student.grades.index') }}">
                                            <i class="fas fa-graduation-cap"></i> Mes Notes
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                                        </a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            <i class="fas fa-user-plus"></i> {{ __('Register') }}
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(Auth::user()->role === 'admin')
                                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                                <i class="fas fa-user-cog"></i> {{ __('Profile') }}
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('student.profile.edit') }}">
                                                <i class="fas fa-user-cog"></i> {{ __('Profile') }}
                                            </a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        @stack('scripts')
    </body>
</html>
