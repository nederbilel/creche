@extends('activites.app')

@section('content')
<div class="container">
    <h1>Détails de l'Activité</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h2>{{ $activite->nom_activite }}</h2>
            <p>{{ $activite->description_activite }}</p>

            @if($activite->videos->isNotEmpty())
                <div class="mb-3">
                    <p>Vidéos:</p>
                    @foreach($activite->videos as $video)
                        <video controls style="max-width: 100%; height: auto;">
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                    @endforeach
                </div>
            @endif

            @if($activite->photos->isNotEmpty())
                <div class="mb-3">
                    <p>Photos:</p>
                    @foreach($activite->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo de l'activité" class="img-fluid" style="max-height: 200px; margin-right: 5px;">
                    @endforeach
                </div>
            @endif

            <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('activites.destroy', $activite->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>

    <a href="{{ route('activites.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
