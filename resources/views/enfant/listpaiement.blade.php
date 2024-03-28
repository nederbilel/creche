@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color :#368062">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Paiement Assurences</a></li>
    </ol>
</nav>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
   
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="mb-3">
                <a href="{{ route('enfant.paiement') }}" class="btn btn-success">Ajouter Paiement</a>
            </div>
            <form method="GET" action="{{ route('enfant.paiement.list') }}">
                <div class="mb-3">
                    <label for="year-filter" class="form-label">Select Year:</label>
                    <select class="form-select" id="year-filter" name="year" onchange="this.form.submit()">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if ($paiements->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom Enfant</th>
                            <th scope="col">Date</th>
                            <th scope="col">Valeur</th>
                            <th scope="col">Année</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                            <tr>
                                <td>{{ $paiement->enfant->nom }}</td>
                                <td>{{ $paiement->date }}</td>
                                <td>{{ $paiement->valeur }}</td>
                                <td>{{ $paiement->annee }}</td>
                                <td>
                                    <a href="{{ route('enfant.editpaiement', $paiement->id) }}" class="btn btn-primary">Modifier</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $paiement->id }}">
                                        Supprimer
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce paiement ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('enfant.destroypaiement', $paiement->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Aucun paiement trouvé pour l'année sélectionnée.</div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
