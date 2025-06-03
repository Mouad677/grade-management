@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Créer un nouvel utilisateur</h2>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" name="role" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                <option value="assistant" {{ old('role') == 'assistant' ? 'selected' : '' }}>Assistant</option>
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Étudiant</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="student_code" class="form-label">Code étudiant</label>
                            <input type="text" class="form-control @error('student_code') is-invalid @enderror" 
                                   id="student_code" name="student_code" value="{{ old('student_code') }}">
                            <div class="form-text">Obligatoire uniquement pour les étudiants</div>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" name="first_name" value="{{ old('first_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" name="last_name" value="{{ old('last_name') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Créer l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const studentCodeField = document.getElementById('student_code');

    function toggleStudentCode() {
        if (roleSelect.value === 'student') {
            studentCodeField.required = true;
        } else {
            studentCodeField.required = false;
        }
    }

    roleSelect.addEventListener('change', toggleStudentCode);
    toggleStudentCode(); // Initial check
});
</script>
@endpush 