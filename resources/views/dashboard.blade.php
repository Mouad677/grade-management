@extends('layouts.app')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Auth::user()->role === 'admin')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Utilisateurs -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">Utilisateurs</h5>
                                            <span class="h3 text-primary mb-0">{{ \App\Models\User::where('role', 'student')->count() }}</span>
                                        </div>
                                        <p class="card-text text-muted">Gérer les étudiants</p>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Voir les utilisateurs</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">Notes</h5>
                                            <span class="h3 text-success mb-0">{{ \App\Models\Grade::count() }}</span>
                                        </div>
                                        <p class="card-text text-muted">Gérer les notes</p>
                                        <a href="{{ route('admin.grades.index') }}" class="btn btn-success">Voir les notes</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">Admin</h5>
                                            <span class="h3 text-info mb-0">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                                        </div>
                                        <p class="card-text text-muted">Gérer le profil</p>
                                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-info">Voir le profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (Auth::user()->role === 'assistant')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Notes</h5>
                                        <p class="card-text">Gérer les notes des étudiants</p>
                                        <a href="{{ route('admin.grades.index') }}" class="btn btn-primary">Voir les notes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Profil</h5>
                                        <p class="card-text">Voir mes informations</p>
                                        <a href="{{ route('student.profile.show') }}" class="btn btn-primary">Voir le profil</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Notes</h5>
                                        <p class="card-text">Voir mes notes</p>
                                        <a href="{{ route('student.grades.index') }}" class="btn btn-primary">Voir les notes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
