@extends('enfant.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color :#2e90d6">Home</a></li>
        <li class="breadcrumb-item"><a href="/enfants" style="color :#2e90d6">List d'enfants</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nouveau enfant</li>
    </ol>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('enfants.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Information Enfant -->
                <div class="mb-4">
                    <h4 class="text-decoration-underline fst-italic">Information Enfant</h4>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            {{-- <label for="picture" class="form-label">Photo Enfant</label> --}}
                            <img src="{{ asset('/storage/' . $enfant->picture_path) }}" alt="Enfant's Picture" class="img-thumbnail" style="width: 75px; height: 75px; border-radius: 50%;" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('/storage/' . $enfant->picture_path) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nom" class="form-label" style="color : #2e90d6">Nom</label>
                            <p>{{ $enfant->nom }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="maladie" class="form-label" style="color : #2e90d6">Maladie</label>
                            <p>{{ $enfant->maladie }}</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="date_de_naissance" class="form-label" style="color : #2e90d6">Date de Naissance</label>
                            <p>{{ $enfant->date_de_naissance }}</p>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="vaccin" class="form-label" style="color : #2e90d6">Vaccin</label>
                            <p>{{ $enfant->vaccin }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="adresse" class="form-label" style="color : #2e90d6">Adresse</label>
                            <p>{{ $enfant->adresse }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="description" class="form-label" style="color : #2e90d6">Description</label>
                            <p>{{ $enfant->description }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="frais_inscription" class="form-label" style="color : #2e90d6">Frais d'inscription</label>
                            <p>{{ $enfant->frais_inscription }}</p>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <hr>
                <div class="mb-4">
                    <h4 class="text-decoration-underline fst-italic">Documents</h4>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="caret_enfant" class="form-label">Carnet Enfant</label>
                            <div class="col-md-4 mb-3">
                                {{-- <label for="picture" class="form-label">Photo Enfant</label> --}}
                                <img src="{{ asset('/storage/' . $enfant->caret_enfant) }}" alt="Enfant's carnet" class="img-thumbnail" style="width: 150px; height: 75px;" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('/storage/' . $enfant->caret_enfant) }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="cin_parent" class="form-label">CIN Parent</label>
                            <div class="col-md-4 mb-3">
                                {{-- <label for="picture" class="form-label">Photo Enfant</label> --}}
                                <img src="{{ asset('/storage/' . $enfant->cin_parent) }}" alt="CIN Parent" class="img-thumbnail" style="width: 150px; height: 75px;" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('/storage/' . $enfant->cin_parent) }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="certif_enfant" class="form-label">Certif Enfant</label>
                            <div class="col-md-4 mb-3">
                                {{-- <label for="picture" class="form-label">Photo Enfant</label> --}}
                                <img src="{{ asset('/storage/' . $enfant->certif_enfant) }}" alt="Certif Enfant" class="img-thumbnail" style="width: 150px; height: 75px;" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('/storage/' . $enfant->certif_enfant) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="extrait_de_naissance" class="form-label">Extrait de Naissance</label>
                            <div class="col-md-4 mb-3">
                                {{-- <label for="picture" class="form-label">Photo Enfant</label> --}}
                                <img src="{{ asset('/storage/' . $enfant->extrait_de_naissance) }}" alt="Extrait de Naissance" class="img-thumbnail" style="width: 150px; height: 75px;" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('/storage/' . $enfant->extrait_de_naissance) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Parents -->
                <hr>
                <div class="mb-4">
                    <h4 class="text-decoration-underline fst-italic">Information Parents</h4>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nom_mere" class="form-label" style="color : #2e90d6">Nom de la Mère</label>
                            <p>{{ $enfant->nom_mere }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="telephone1" class="form-label" style="color : #2e90d6">Téléphone de la mère</label>
                            <p>{{ $enfant->telephone1 }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="travail_mere" class="form-label" style="color : #2e90d6">Travail de la Mère</label>
                            <p>{{ $enfant->travail_mere }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nom_pere" class="form-label" style="color : #2e90d6">Nom du Père</label>
                            <p>{{ $enfant->nom_pere }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="telephone2" class="form-label" style="color : #2e90d6">Téléphone du Père</label>
                            <p>{{ $enfant->telephone2 }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="travail_pere" class="form-label" style="color : #2e90d6">Travail du Père</label>
                            <p>{{ $enfant->travail_pere }}</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="modal-image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var imgSrc = button.data('img') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#modal-image').attr('src', imgSrc)
        })
    });
</script>
@endsection
