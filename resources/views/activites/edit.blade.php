@extends('activites.app')

@section('content')
<div class="container">
    <h1>Modifier l'Activité</h1>

    <form action="{{ route('activites.update', $activite->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nom de l'Activité -->
        <div class="form-group">
            <label for="nom_activite">Nom de l'Activité</label>
            <input type="text" name="nom_activite" class="form-control" value="{{ old('nom_activite', $activite->nom_activite) }}" required>
        </div>

        <!-- Description de l'Activité -->
        <div class="form-group">
            <label for="description_activite">Description de l'Activité</label>
            <textarea name="description_activite" class="form-control" required>{{ old('description_activite', $activite->description_activite) }}</textarea>
        </div>

        <!-- Changer Vidéos -->
        <div class="form-group">
            <label for="videos">Changer Vidéos</label>
            <input type="file" name="videos[]" class="form-control-file" multiple>
            
            @if($activite->videos->isNotEmpty())
                <div class="mt-3">
                    <p>Vidéos actuelles:</p>
                    @foreach($activite->videos as $video)
                        <div class="mb-2">
                            <video controls style="max-width: 100%; height: auto;">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Changer Photos -->
        <div class="form-group">
            <label for="photos">Changer Photos</label>
            <input type="file" name="photos[]" class="form-control-file" multiple>
            
            @if($activite->photos->isNotEmpty())
                <div class="mt-3">
                    <p>Photos actuelles:</p>
                    @foreach($activite->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo de l'activité" class="img-fluid" style="max-height: 200px; margin-right: 5px;">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
