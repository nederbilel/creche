@extends('activites.app')

@section('content')
<div class="container">
    <h1>Liste des Activités</h1>

    <a href="{{ route('activites.create') }}" class="btn btn-primary mb-3">Ajouter une Activité</a>

    @if($activites->isEmpty())
        <p>Aucune activité trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Date</th>
                    {{-- <th>Vid</th>
                    <th>Photo</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activites as $activite)
                <tr>
                    <td>{{ $activite->nom_activite }}</td>
                    <td>{{ $activite->description_activite }}</td>
                    <td>{{ $activite->created_at->format('d-m-Y H:i') }}</td> <!-- Display the date -->
                    {{-- <td>
                        @if($activite->photos->isNotEmpty())
                            @foreach($activite->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="Photo de l'activité" style="max-height: 100px; margin-right: 5px;">
                            @endforeach
                        @else
                            Pas de photo
                        @endif
                    </td>
                    <td>
                        @if($activite->video_url)
                            <a href="{{ asset('storage/' . $activite->video_url) }}" target="_blank">Voir la Vidéo</a>
                        @else
                            Pas de vidéo
                        @endif
                    </td> --}}
                    <td>
                        <a href="{{ route('activites.show', $activite->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('activites.destroy', $activite->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
