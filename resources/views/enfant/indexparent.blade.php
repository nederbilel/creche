@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste des Parents</li>
    </ol>
</nav>

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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col">
                    <h1>Liste des Parents</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('parents.create') }}" class="btn btn-success" style="background-color: #2e90d6;">Ajouter un Parent</a>
                </div>
            </div>

            @if ($parents->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parents as $parent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $parent->name }}</td>
                                <td>{{ $parent->email }}</td>
                                <td>
                                    <a href="{{ route('parents.edit', $parent->id) }}" class="btn btn-primary">Modifier</a>
                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $parent->id }}">
                                        Supprimer
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $parent->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce parent ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('parents.destroy', $parent->id) }}" method="POST">
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
                <div class="alert alert-info">Aucun parent trouvé.</div>
            @endif
        </div>
    </div>
</div>

@endsection
