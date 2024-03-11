@extends('enfant.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
                            <label for="annee">Mois:</label>
                            <input type="text" name="mois" class="form-control" value="{{ $paiement->mois }}">
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
