@extends('enfant.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Liste des Enfants</h1>
            <a class="btn btn-success mb-3" href="{{ route('enfants.create') }}">Ajouter un Enfant</a>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Date de Naissance</th>
                            <th scope="col">Nom de la Mère</th>
                            <th scope="col">Nom du Père</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enfants as $enfant)
                        <tr>
                            <td>{{ $enfant->nom }}</td>
                            <td>{{ $enfant->date_de_naissance }}</td>
                            <td>{{ $enfant->nom_mere }}</td>
                            <td>{{ $enfant->nom_pere }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('enfants.show', $enfant->id) }}">Voir</a>
                                <a class="btn btn-warning btn-sm" href="{{ route('enfants.edit', $enfant->id) }}">Modifier</a>
                                <!-- Delete Button with Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $enfant->id }}">
                                    Supprimer
                                </button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $enfant->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $enfant->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $enfant->id }}">Confirmer la suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cet enfant ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <!-- Form to handle the actual delete action -->
                                                <form method="POST" action="{{ route('enfants.destroy', $enfant->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirmer</button>
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
            </div>
        </div>
    </div>
</div>
@endsection
