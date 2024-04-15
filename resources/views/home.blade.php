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
        <div class="card mb-4">
            <i class="fas fa-chart-area me-1"></i>
            
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Enfants n'ayant pas encore payé pour ce mois!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
    
            
   <style>
    .notification {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    padding: 1rem;
    border-radius: 0.25rem;
    position: relative;
}

.notification .btn-close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    color: #721c24;
}

   </style>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Section 2
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
                    Section 3
                </div>
                <div class="card-body">
                    <!-- Content for section 4 goes here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
