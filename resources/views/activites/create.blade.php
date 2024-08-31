@extends('activites.app')

@section('content')
<div class="container">
    <h1>Ajouter une Activité</h1>

    <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom_activite">Nom de l'Activité</label>
            <input type="text" name="nom_activite" class="form-control" value="{{ old('nom_activite') }}" required>
        </div>

        <div class="form-group">
            <label for="description_activite">Description de l'Activité</label>
            <textarea name="description_activite" class="form-control" required>{{ old('description_activite') }}</textarea>
        </div>

        <div class="form-group">
            <label for="videos">Ajouter des Vidéos</label>
            <input type="file" name="videos[]" class="form-control-file" multiple>
        </div>
        

        <div class="form-group">
            <label for="photos">Ajouter des Photos</label>
            <input type="file" name="photos[]" class="form-control-file" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
