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

        <!-- Custom Styles (copié du layout principal) -->
        <style>
            :root {
                --primary-color: #FF6B35;
                --secondary-color: #2ECC71;
                --accent-color: #FF9F1C;
                --text-color: #2C3E50;
                --light-bg: #F8F9FA;
                --dark-bg: #2C3E50;
            }
            body {
                font-family: 'Poppins', sans-serif;
                color: var(--text-color);
                background-color: var(--light-bg);
            }
            html, body, .container-fluid, .row {
                height: 100vh !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .container-fluid, .row {
                min-height: 100vh !important;
            }
            .login-card-custom {
                background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
                border: none;
                border-radius: 0;
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
                color: white;
                padding: 2.5rem 2rem;
                display: flex;
                flex-direction: column;
                justify-content: center;
                height: 100%;
            }
            .login-card-custom .form-control {
                border-radius: 0;
                padding: 0.75rem 1rem;
                border: 2px solid #e9ecef;
                margin-bottom: 1rem;
            }
            .login-card-custom .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            }
            .login-card-custom .btn-primary {
                background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
                border: none;
                font-weight: 600;
                letter-spacing: 0.5px;
                border-radius: 0;
                padding: 0.75rem 0;
                margin-top: 1rem;
            }
            .login-card-custom .btn-primary:hover {
                background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
            }
            .login-card-custom label, .login-card-custom h2, .login-card-custom p, .login-card-custom a {
                color: white !important;
            }
            .login-card-custom a {
                text-decoration: underline;
            }
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen d-flex flex-column justify-content-center align-items-center bg-light">
            <div class="container-fluid">
                <div class="row" style="height: 100vh;">
                    <div class="col-md-8 p-0">
                        <img src="{{ asset('images/picture-login.jpeg') }}" alt="Login Image" class="img-fluid w-100 h-100" style="object-fit: cover; height: 100vh;">
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center p-0" style="height: 100vh;">
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="max-width: 600px; width: 100%;">
                            <div class="w-100 login-card-custom" style="height: 100%;">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
