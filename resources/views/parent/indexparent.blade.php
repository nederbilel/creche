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
                    <a href="{{ route('parents.create') }}" class="btn btn-success" style="background-color: #2e90d6; border: none; border-radius: 25px;">
                        <svg width="24" height="24" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M10 1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM2.5 13.5a4.5 4.5 0 0 1 9 0v.5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5v-.5zM14 11a2 2 0 1 0-4 0v.5h-2V11a2 2 0 1 0-4 0v.5H3.5a.5.5 0 0 0-.5.5v.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-.5a.5.5 0 0 0-.5-.5H14v-.5z"/>
                        </svg>
                        Ajouter un Parent
                    </a>
                </div>
            </div>

            @if ($parents->count() > 0)
                <table class="table table-striped table-bordered">
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
                                    <a href="{{ route('parents.edit', $parent->id) }}" class="btn btn-primary btn-sm">
                                        <svg width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708.708L4.707 9.207a1.5 1.5 0 0 1-.546.275l-2.205.735a.5.5 0 0 1-.637-.637l.735-2.205a1.5 1.5 0 0 1 .275-.546L12.146.146zM13.5 1a.5.5 0 0 0-.5.5v2.707l-3.146 3.146a.5.5 0 0 0-.146.354v3.5a.5.5 0 0 0 .5.5h3.5a.5.5 0 0 0 .5-.5v-3.5a.5.5 0 0 0-.146-.354L13.5 4.207V1.5a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        Modifier
                                    </a>
                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $parent->id }}">
                                        <svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M2.5 1.5A.5.5 0 0 1 3 1h10a.5.5 0 0 1 .5.5V2h-11v-.5zM2 2.5h12v11a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-11zM3 3h10v11H3V3z"/>
                                        </svg>
                                        Supprimer
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $parent->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $parent->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $parent->id }}">Confirmation de suppression</h5>
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
