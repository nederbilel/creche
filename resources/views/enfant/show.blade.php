@extends('enfant.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Détails de l'Enfant</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nom:</strong> {{ $enfant->nom }}</li>
                        <li class="list-group-item"><strong>Date de Naissance:</strong> {{ $enfant->date_de_naissance }}</li>
                        <li class="list-group-item"><strong>Nom de la Mère:</strong> {{ $enfant->nom_mere }}</li>
                        <li class="list-group-item"><strong>Nom du Père:</strong> {{ $enfant->nom_pere }}</li>
                        <li class="list-group-item"><strong>Téléphone 1:</strong> {{ $enfant->telephone1 }}</li>
                        <li class="list-group-item"><strong>Téléphone 2:</strong> {{ $enfant->telephone2 }}</li>
                        <li class="list-group-item"><strong>Travail du Père:</strong> {{ $enfant->travail_pere }}</li>
                        <li class="list-group-item"><strong>Travail de la Mère:</strong> {{ $enfant->travail_mere }}</li>
                        <li class="list-group-item"><strong>Vaccin:</strong> {{ $enfant->vaccin }}</li>
                        <li class="list-group-item"><strong>Adresse:</strong> {{ $enfant->adresse }}</li>
                        <li class="list-group-item"><strong>Maladie:</strong> {{ $enfant->maladie }}</li>
                        <li class="list-group-item"><strong>Description:</strong> {{ $enfant->description }}</li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
