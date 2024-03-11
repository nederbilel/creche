@extends('enfant.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="mb-3">
                <a href="{{ route('enfant.paiementmois') }}" class="btn btn-success">Ajouter Paiement</a>
            </div>
            <div id="paiements-container">
                @foreach($paiements as $mois => $paiementsByMois)
                    <h3>Paiements pour {{ $mois }}</h3>
                    <table class="table">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th scope="col">Nom Enfant</th>
                                <th scope="col">Date de paiement</th>
                                <th scope="col">Valeur</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @foreach($paiementsByMois as $paiement)
                                <!-- Table rows -->
                                <tr>
                                    <td>{{ $paiement->enfant->nom }}</td>
                                    <td>{{ $paiement->date }}</td>
                                    <td>{{ $paiement->valeur }}</td>
                                    <td>
                                        <!-- Actions buttons -->
                                        <a href="{{ route('enfant.editpaiementmois', $paiement->id) }}" class="btn btn-primary">Modifier</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $paiement->id }}">Supprimer</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal header -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer ce paiement ?
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('enfant.destroypaiementmois', $paiement->id) }}" method="POST">
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
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
