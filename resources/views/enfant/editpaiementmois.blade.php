@extends('enfant.app')

@section('content')


<nav aria-label="breadcrumb">
<ol class="breadcrumb" style="background-color: #ffffff">
    <li class="breadcrumb-item"><a href="/home" style="color :#2e90d6">Home</a></li>
    <li class="breadcrumb-item"><a href="/paiementmoisList" style="color :#2e90d6">Paiement Mensuel</a></li>
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
                <div class="card-header">Modifier Paiement Mensuel</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paiementmois.update', $paiement->id) }}">
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

                        <div class="form-group">
                            <label for="mois">Mois :</label>
                            <select class="form-control" id="mois" name="mois" required  value="{{ $paiement->mois }}">
                                <option value="">Sélectionner un mois</option>
                                <option value="Janvier">Janvier</option>
                                <option value="Février">Février</option>
                                <option value="Mars">Mars</option>
                                <option value="Avril">Avril</option>
                                <option value="Mai">Mai</option>
                                <option value="Juin">Juin</option>
                                <option value="Juillet">Juillet</option>
                                <option value="Août">Août</option>
                                <option value="Septembre">Septembre</option>
                                <option value="Octobre">Octobre</option>
                                <option value="Novembre">Novembre</option>
                                <option value="Décembre">Décembre</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{ route('enfant.paiementmois.list') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
