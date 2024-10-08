@extends('enfant.app')

@section('content')



<nav aria-label="breadcrumb">
<ol class="breadcrumb" style="background-color: #ffffff">
    <li class="breadcrumb-item"><a href="/home" style="color :#2e90d6">Home</a></li>
    <li class="breadcrumb-item"><a href="/paiementList" style="color :#2e90d6">Paiement Assurences</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier paiement</li>
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
                <div class="card-header">Modifier Paiement</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paiement.update', $paiement->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="enfant_id">Enfant:</label>
                            <select name="enfant_id" class="form-control">
                                @foreach($enfants as $enfant)
                                <option value="{{ $enfant->id }}" @if ($enfant->id == $paiement->enfant_id) selected @endif>{{ $enfant->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" class="form-control" value="{{ $paiement->date }}">
                        </div>

                        <div class="form-group">
                            <label for="valeur">Valeur:</label>
                            <input type="number" name="valeur" class="form-control" value="{{ $paiement->valeur }}">
                        </div>

                        <div class="form-group">
                            <label for="annee">Année:</label>
                            <input type="text" name="annee" class="form-control" value="{{ $paiement->annee }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{ route('enfant.paiement.list') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
