@extends('parent.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Liste des Activités</h1>

    @if($activites->isEmpty())
        <div class="alert alert-warning text-center">Aucune activité trouvée.</div>
    @else
        @php
            $currentDate = null;
        @endphp

        @foreach($activites as $activite)
            @if ($activite->created_at->format('d-m-Y') !== $currentDate)
                @if ($currentDate !== null)
                    </div> <!-- End of previous row -->
                @endif
                <h3 class="my-4 text-muted">{{ \Carbon\Carbon::parse($activite->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</h3>
                <div class="d-flex flex-wrap justify-content-between"> <!-- Start of new flex container -->
                @php
                    $currentDate = $activite->created_at->format('d-m-Y');
                @endphp
            @endif
            
            <div class="card mb-4 flex-grow-1" 
            style="min-width: 50%; 
                   max-width: 50%; 
                   margin-right: 0; 
                   min-height: 50%; 
                   max-height: 50%; 
                   display: flex; 
                   flex-direction: column;"> 
        
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $activite->nom_activite }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($activite->description_activite, 50) }}</p>
            </div>
        
            @if($activite->photos->isNotEmpty())
                <div id="carouselPhotos{{ $activite->id }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($activite->photos as $index => $photo)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $photo->path) }}" class="d-block w-100" alt="Photo de l'activité" style="width: 50%; height: 50%; object-fit: cover; margin: 0 auto;">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselPhotos{{ $activite->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédent</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselPhotos{{ $activite->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivant</span>
                    </a>
                </div>
            @else
                <img src="{{ asset('images/no-image-available.png') }}" class="card-img-top" alt="Pas de photo disponible" style="width: 50%; height: 50%; object-fit: cover; margin: 0 auto;">
            @endif
        
            @if($activite->videos->isNotEmpty())
                <div class="mt-2">
                    @foreach($activite->videos as $video)
                    <video controls style="width: 50%; height: 50%; object-fit: cover; margin: 0 auto;">
                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center mt-2">
                    
                </p>
            @endif
        
            <div class="card-footer text-center mt-auto">
                <a href="{{ route('activitesparent.show', $activite->id) }}" class="btn btn-outline-primary btn-block">Voir les détails</a>
            </div>
        </div>
        
            @if ($loop->last)
                </div> <!-- End of last flex container -->
            @endif
        @endforeach
    @endif
</div>
@endsection
