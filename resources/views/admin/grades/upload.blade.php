@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Importer des Notes</h2>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.grades.import') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="file" class="form-label">Fichier CSV</label>
                            <div class="border rounded p-4 text-center">
                                <div class="mb-3">
                                    <i class="fas fa-file-csv fa-3x text-primary"></i>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="btn btn-primary">
                                        <i class="fas fa-upload me-2"></i>Choisir un fichier
                                        <input type="file" class="d-none" id="file" name="file" accept=".csv" required>
                                    </label>
                                </div>
                                <p class="text-muted mb-0">
                                    ou glisser-déposer votre fichier ici
                                </p>
                                <p class="text-muted small mt-2">
                                    Format CSV requis. Les colonnes doivent être : student_code, module_code, module_name, grade, semester, year
                                </p>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-import me-2"></i>Importer les notes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .border {
        border: 2px dashed #dee2e6 !important;
    }
    .border:hover {
        border-color: #0d6efd !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.querySelector('.border');
        const fileInput = document.getElementById('file');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-primary');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-primary');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
        }
    });
</script>
@endpush
@endsection
