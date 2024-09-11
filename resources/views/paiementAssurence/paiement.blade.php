@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #f8f9fa;">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6;">Home</a></li>
        <li class="breadcrumb-item"><a href="/paiementList" style="color: #2e90d6;">Paiement Assurances</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nouvel Paiement</li>
    </ol>
</nav>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Nouvel Paiement Assurance</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('enfant.paiement.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom_enfant">Nom de l'enfant :</label>
                            <select name="enfant_id" class="form-control">
                                @foreach($enfants as $enfant)
                                    <option value="{{ $enfant->id }}">{{ $enfant->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date de paiement :</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="valeur">Montant :</label>
                            <input type="number" name="valeur" class="form-control" placeholder="Montant en €">
                        </div>
                        <div class="form-group">
                            <label for="annee">Année :</label>
                            <input type="text" name="annee" class="form-control" placeholder="Année">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
