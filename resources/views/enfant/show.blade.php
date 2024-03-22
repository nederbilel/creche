@extends('enfant.app')

@section('content')
<nav aria-label="breadcrumb" >
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item" > <a href="/home" style="color :#368062">Home</a></li>
        <li class="breadcrumb-item"><a href="/enfants" style="color :#368062">List d'enfants</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details enfant</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row justify-content-center">
     
        <div class="col-lg-12">
          
            
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Profil de l'Enfant</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="text-center" style="margin-top: 50px">
                                @if($enfant->picture_path)
                                <img src="{{ asset('storage/' . $enfant->picture_path) }}" alt="Enfant's Picture" style="border-radius: 50%; width: 200px; height: 200px;" class="img-fluid">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2 class="mt-4">Information Enfant</h2>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Nom:</strong> {{ $enfant->nom }}</li>
                                        <li class="list-group-item"><strong>Date de Naissance:</strong> {{ $enfant->date_de_naissance }}</li>
                                        <li class="list-group-item"><strong>Vaccin:</strong> {{ $enfant->vaccin }}</li>
                                        <li class="list-group-item"><strong>Maladie:</strong> {{ $enfant->maladie }}</li>
                                        <li class="list-group-item"><strong>Description:</strong> {{ $enfant->description }}</li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <h2 class="mt-4">Information Parents</h2>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Nom de la Mère:</strong> {{ $enfant->nom_mere }}</li>
                                        <li class="list-group-item"><strong>Nom du Père:</strong> {{ $enfant->nom_pere }}</li>
                                        <li class="list-group-item"><strong>Téléphone 1:</strong> {{ $enfant->telephone1 }}</li>
                                        <li class="list-group-item"><strong>Téléphone 2:</strong> {{ $enfant->telephone2 }}</li>
                                        <li class="list-group-item"><strong>Travail du Père:</strong> {{ $enfant->travail_pere }}</li>
                                        <li class="list-group-item"><strong>Travail de la Mère:</strong> {{ $enfant->travail_mere }}</li>
                                        <li class="list-group-item"><strong>Adresse:</strong> {{ $enfant->adresse }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
