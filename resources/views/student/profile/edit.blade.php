@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-gradient text-white">
                    <h4 class="mb-0">Modifier mon profil</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.profile.update') }}" id="profileForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('student.profile.show') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary" id="saveButton">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 1rem 1rem 0 0 !important;
        padding: 1.5rem;
    }

    .card-header h4 {
        color: white;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-color);
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

    .btn {
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
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

    .btn-outline-secondary {
        border: 2px solid #e9ecef;
        color: var(--text-color);
    }

    .btn-outline-secondary:hover {
        background-color: #e9ecef;
        color: var(--text-color);
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
    }
</style>

<script>
    document.getElementById('profileForm').addEventListener('input', function() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const saveButton = document.getElementById('saveButton');
        
        if (name && email) {
            saveButton.style.background = 'linear-gradient(135deg, #2ECC71, #27AE60)';
        } else {
            saveButton.style.background = 'linear-gradient(135deg, #FF6B35, #FF9F1C)';
        }
    });
</script>
@endsection 