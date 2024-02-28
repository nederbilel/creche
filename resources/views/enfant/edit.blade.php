@extends('enfant.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Modifier Enfant</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enfants.update', $enfant->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom:</label>
                            <input type="text" id="nom" name="nom" value="{{ $enfant->nom }}" class="form-control">
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date_de_naissance" class="form-label">Date de Naissance:</label>
                            <input type="date" id="date_de_naissance" name="date_de_naissance" value="{{ $enfant->date_de_naissance }}" class="form-control">
                            @error('date_de_naissance')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nom_mere" class="form-label">Nom de la Mère:</label>
                            <input type="text" id="nom_mere" name="nom_mere" value="{{ $enfant->nom_mere }}" class="form-control">
                            @error('nom_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nom_pere" class="form-label">Nom du Père:</label>
                            <input type="text" id="nom_pere" name="nom_pere" value="{{ $enfant->nom_pere }}" class="form-control">
                            @error('nom_pere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telephone1" class="form-label">Téléphone 1:</label>
                            <input type="text" id="telephone1" name="telephone1" value="{{ $enfant->telephone1 }}" class="form-control">
                            @error('telephone1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telephone2" class="form-label">Téléphone 2:</label>
                            <input type="text" id="telephone2" name="telephone2" value="{{ $enfant->telephone2 }}" class="form-control">
                            @error('telephone2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="travail_pere" class="form-label">Travail du Père:</label>
                            <input type="text" id="travail_pere" name="travail_pere" value="{{ $enfant->travail_pere }}" class="form-control">
                            @error('travail_pere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="travail_mere" class="form-label">Travail de la Mère:</label>
                            <input type="text" id="travail_mere" name="travail_mere" value="{{ $enfant->travail_mere }}" class="form-control">
                            @error('travail_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="vaccin" class="form-label">Vaccin:</label>
                            <input type="text" id="vaccin" name="vaccin" value="{{ $enfant->vaccin }}" class="form-control">
                            @error('vaccin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse:</label>
                            <input type="text" id="adresse" name="adresse" value="{{ $enfant->adresse }}" class="form-control">
                            @error('adresse')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="maladie" class="form-label">Maladie:</label>
                            <input type="text" id="maladie" name="maladie" value="{{ $enfant->maladie }}" class="form-control">
                            @error('maladie')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" name="description" class="form-control">{{ $enfant->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
