@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestion des Notes</h5>
                    <a href="{{ route('admin.grades.uploadForm') }}" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Importer des Notes
                    </a>
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

                    <div class="mb-4">
                        <form action="{{ route('admin.grades.search') }}" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="type" class="form-select">
                                    <option value="student" {{ request('type') == 'student' ? 'selected' : '' }}>Étudiant</option>
                                    <option value="subject" {{ request('type') == 'subject' ? 'selected' : '' }}>Matière</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Niveau</th>
                                    <th>Module</th>
                                    <th>Note CT</th>
                                    <th>Note EX</th>
                                    <th>Note Finale</th>
                                    <th>Professeur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grades as $grade)
                                    @php
                                        $comment = json_decode($grade->comment, true);
                                    @endphp
                                    <tr>
                                        <td>{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
                                        <td>{{ $comment['level'] }}</td>
                                        <td>{{ $grade->subject->name }}</td>
                                        <td>{{ $comment['note_ct'] }}</td>
                                        <td>{{ $comment['note_ex'] }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td>{{ $comment['professor_name'] }}</td>
                                        <td>
                                            <form action="{{ route('admin.grades.destroy', $grade) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucune note trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $grades->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

