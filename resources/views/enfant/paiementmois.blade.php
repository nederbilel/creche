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
        <div class="col-md-10">
            <h1>Nouvel Paiement </h1>
            <form action="{{ route('enfant.paiementmois.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom_enfant">Nom Enfant:</label>
                    <select name="enfant_id" class="form-control">
                        @foreach($enfants as $enfant)
                            <option value="{{ $enfant->id }}">{{ $enfant->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date de paiement:</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="valeur">Valeur:</label>
                    <input type="number" name="valeur" class="form-control">
                </div>
            
                <div class="form-group">
                    <label for="mois">Mois :</label>
                    <select class="form-control" id="mois" name="mois" required>
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
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
