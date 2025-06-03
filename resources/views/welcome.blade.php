@extends('layouts.app')

@section('content')
<div class="welcome-page">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">
                Bienvenue sur le Système de Gestion des Notes
            </h1>
            <p class="lead mb-5 animate__animated animate__fadeInUp">
                Une plateforme moderne pour la gestion efficace des notes et le suivi académique
            </p>
            @guest
                <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Inscription
                    </a>
                </div>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Fonctionnalités Principales</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card card h-100">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                            </div>
                            <h3 class="card-title h4">Gestion des Notes</h3>
                            <p class="card-text">Suivez et gérez facilement les notes des étudiants avec notre système intuitif.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card card h-100">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-users fa-3x text-primary"></i>
                            </div>
                            <h3 class="card-title h4">Gestion des Utilisateurs</h3>
                            <p class="card-text">Administrez les comptes utilisateurs avec différents niveaux d'accès.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card card h-100">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-4">
                                <i class="fas fa-chart-line fa-3x text-primary"></i>
                            </div>
                            <h3 class="card-title h4">Suivi des Performances</h3>
                            <p class="card-text">Analysez les performances académiques avec des statistiques détaillées.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Comment ça marche ?</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">1</div>
                        <h4>Créez un compte</h4>
                        <p>Inscrivez-vous en tant qu'étudiant ou administrateur</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">2</div>
                        <h4>Accédez à votre espace</h4>
                        <p>Connectez-vous à votre tableau de bord personnalisé</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">3</div>
                        <h4>Gérez les notes</h4>
                        <p>Importez et gérez les notes des étudiants</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">4</div>
                        <h4>Suivez les progrès</h4>
                        <p>Consultez les statistiques et rapports</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <h2 class="mb-4">Prêt à commencer ?</h2>
            <p class="lead mb-4">Rejoignez notre plateforme et simplifiez la gestion de vos notes</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket me-2"></i>Commencer maintenant
                </a>
            @endguest
        </div>
    </section>
</div>

<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 6rem 0;
        margin-top: -2rem;
        margin-bottom: 2rem;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .hero-section .lead {
        font-size: 1.5rem;
        opacity: 0.9;
    }

    /* Features Section */
    .feature-card {
        transition: transform 0.3s ease;
        border: none;
        background: white;
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        color: white;
    }

    /* How It Works Section */
    .step-card {
        padding: 2rem;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .step-card:hover {
        transform: translateY(-5px);
    }

    .step-number {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 auto 1rem;
    }

    /* Call to Action Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 4rem 0;
    }

    .cta-section .btn {
        padding: 1rem 2rem;
        font-size: 1.2rem;
    }

    /* Animations */
    .animate__animated {
        animation-duration: 1s;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }

        .hero-section .lead {
            font-size: 1.2rem;
        }

        .feature-card {
            margin-bottom: 1rem;
        }

        .step-card {
            margin-bottom: 1rem;
        }
    }
</style>

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
