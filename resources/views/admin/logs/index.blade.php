@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Logs du système</h5>
                    <a href="{{ route('admin.logs.download') }}" class="btn btn-primary">
                        <i class="fas fa-download"></i> Télécharger les logs
                    </a>
                </div>

                <div class="card-body">
                    @if(empty($logs))
                        <div class="alert alert-info">
                            Aucun log disponible.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td>{{ $log['date'] }}</td>
                                            <td>{{ $log['message'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush 