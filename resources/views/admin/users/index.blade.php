@extends('layouts.app')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Gestion des Utilisateurs</h2>
                    <div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nouvel Utilisateur
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllStudentsModal">
                            <i class="fas fa-trash"></i> Supprimer tous les étudiants
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.users.search') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher un utilisateur..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Code Étudiant</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'assistant' ? 'warning' : 'info') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->student_code ?? '-' }}</td>
                                        <td>{{ $user->first_name ?? '-' }}</td>
                                        <td>{{ $user->last_name ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($user->id !== Auth::id())
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                            </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour la suppression de tous les étudiants -->
<div class="modal fade" id="deleteAllStudentsModal" tabindex="-1" aria-labelledby="deleteAllStudentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllStudentsModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    Attention ! Cette action va supprimer tous les étudiants et leurs notes associées.
                    Cette action est irréversible.
                </p>
                <p>Êtes-vous sûr de vouloir continuer ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.users.destroy-all-students') }}" method="POST">
                    @csrf
                    <input type="hidden" name="confirm" value="true">
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
