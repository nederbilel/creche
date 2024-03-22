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
        <li class="breadcrumb-item"><a href="/home" style="color :#368062">Home</a></li>
        <li class="breadcrumb-item"><a href="/enfants" style="color :#368062">List d'enfants</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nouveau enfant</li>
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('enfants.store') }}" enctype="multipart/form-data">
                @csrf

                <h4 class="text-decoration-underline fst-italic">Information Enfant</h4>
                <div class="row mb-3" style="margin-top: 30px">
                    <div class="col-sm-4">
                        <label for="picture" class="form-label">Photo Enfant</label>
                        <div class="input-group">
                            <input type="file" id="picture" name="picture" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                        </div>
                        @error('picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="maladie" class="form-label">Maladie</label>
                        <input type="text" id="maladie" name="maladie" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                        @error('maladie')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="date_de_naissance" class="form-label">Date de Naissance</label>
                        <input type="date" id="date_de_naissance" name="date_de_naissance" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('date_de_naissance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="vaccin" class="form-label">Vaccin</label>
                        <input type="text" id="vaccin" name="vaccin" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('vaccin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('adresse')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="autorisation_hospitalise" name="autorisation_hospitalise" value="true" class="form-check-input">
                            <label class="form-check-label" for="autorisation_hospitalise">Autorisation d'hospitalisé</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="autorisation_publier" name="autorisation_publier" value="true" class="form-check-input">
                            <label class="form-check-label" for="autorisation_publier">Autorisation de publier ces photos en social media</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input type="checkbox" id="autorisation_sortie" name="autorisation_sortie" value="true" class="form-check-input">
                            <label class="form-check-label" for="autorisation_sortie">Autorisation de sortie en plein air</label>
                        </div>
                    </div>
                </div>

                <hr>

                <h4 class="text-decoration-underline fst-italic">Information Parents</h4>
                <div class="row mb-3" style="margin-top: 30px">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="nom_mere" class="form-label">Nom de la Mère</label>
                            <input type="text" id="nom_mere" name="nom_mere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                            @error('nom_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="telephone1" class="form-label">Téléphone de la mère</label>
                            <input type="text" id="telephone1" name="telephone1" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                            @error('telephone1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="travail_mere" class="form-label">Travail de la Mère</label>
                            <input type="text" id="travail_mere" name="travail_mere" class="form-control rounded-0 border-bottom-0 border-top-0 border-left-0.5 border-right-0" >
                            @error('travail_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="nom_pere" class="form-label">Nom du Père</label>
                        <input type="text" id="nom_pere" name="nom_pere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('nom_pere')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="telephone2" class="form-label">Téléphone du Père</label>
                        <input type="text" id="telephone2" name="telephone2" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('telephone2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="travail_pere" class="form-label">Travail du Père</label>
                        <input type="text" id="travail_pere" name="travail_pere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" >
                        @error('travail_pere')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 text-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary" style="background-color: #368062; width: 300px;">Enregistrer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

