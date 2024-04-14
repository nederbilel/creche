@extends('enfant.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Enfants n'ayant pas encore payé pour ce mois
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($enfantsNotPaid as $enfant)
                            <li>{{ $enfant->nom }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Section 2
                </div>
                <div class="card-body">
                    <!-- Content for section 2 goes here -->
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Section 3
                </div>
                <div class="card-body">
                    <!-- Content for section 3 goes here -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Section 4
                </div>
                <div class="card-body">
                    <!-- Content for section 4 goes here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
