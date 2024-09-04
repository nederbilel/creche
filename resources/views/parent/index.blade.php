@extends('parent.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Fil d'Activités de cette semaine</h1>

    @if($activites->isEmpty())
        <div class="alert alert-warning text-center">Aucune activité trouvée.</div>
    @else
        @foreach($activites as $activite)
        <div class="card my-4">
            <div class="card-body">
                <!-- Display the publication date -->
                <p class="text-muted">{{ \Carbon\Carbon::parse($activite->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</p>

                <p>{{ $activite->nom_activite }}</p>
                <p>{{ $activite->description_activite }}</p>

                @php
                    $photos = $activite->photos->take(4);
                    $totalMediaCount = $activite->photos->count();
                @endphp

                <div class="row no-gutters">
                    @foreach($photos as $index => $photo)
                        <div class="col-6 p-1" style="position: relative;">
                            @if ($index == 3 && $totalMediaCount > 4)
                                <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center text-white" style="background-color: rgba(0, 0, 0, 0.5);">
                                    <span style="font-size: 2rem;">+{{ $totalMediaCount - 4 }}</span>
                                </div>
                            @endif
                            <img src="{{ asset('storage/' . $photo->path) }}" 
                                 class="img-fluid rounded" 
                                 alt="Photo de l'activité" 
                                 style="cursor: pointer; object-fit: cover; width: 100%; height: 200px;"
                                 data-toggle="modal" 
                                 data-target="#photoModal{{ $activite->id }}">
                        </div>
                    @endforeach
                </div>

                @if($activite->videos->isNotEmpty())
                    <div class="mt-3">
                        @foreach($activite->videos as $video)
                        <div class="mb-3">
                            <video controls class="w-100 rounded" style="object-fit: cover; height: 400px;">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal for Photo Viewing -->
        <div class="modal fade" id="photoModal{{ $activite->id }}" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel{{ $activite->id }}" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 d-flex align-items-center justify-content-center">
                        <div id="photoCarousel{{ $activite->id }}" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($activite->photos as $index => $photo)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $photo->path) }}" 
                                         class="d-block w-100 h-100" 
                                         alt="Photo de l'activité" 
                                         style="object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#photoCarousel{{ $activite->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Précédent</span>
                            </a>
                            <a class="carousel-control-next" href="#photoCarousel{{ $activite->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Suivant</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
