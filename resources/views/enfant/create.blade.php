@extends('enfant.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un Enfant</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enfants.store') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="nom" class="col-sm-3 col-form-label">Nom:</label>
                            <div class="col-sm-9">
                                <input type="text" id="nom" name="nom" class="form-control">
                                @error('nom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="date_de_naissance" class="col-sm-3 col-form-label">Date de Naissance:</label>
                            <div class="col-sm-9">
                                <input type="date" id="date_de_naissance" name="date_de_naissance" class="form-control">
                                @error('date_de_naissance')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nom_mere" class="col-sm-3 col-form-label">Nom de la Mère:</label>
                            <div class="col-sm-9">
                                <input type="text" id="nom_mere" name="nom_mere" class="form-control">
                                @error('nom_mere')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nom_pere" class="col-sm-3 col-form-label">Nom du Père:</label>
                            <div class="col-sm-9">
                                <input type="text" id="nom_pere" name="nom_pere" class="form-control">
                                @error('nom_pere')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="telephone1" class="col-sm-3 col-form-label">Téléphone 1:</label>
                            <div class="col-sm-9">
                                <input type="text" id="telephone1" name="telephone1" class="form-control">
                                @error('telephone1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="telephone2" class="col-sm-3 col-form-label">Téléphone 2:</label>
                            <div class="col-sm-9">
                                <input type="text" id="telephone2" name="telephone2" class="form-control">
                                @error('telephone2')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="travail_pere" class="col-sm-3 col-form-label">Travail du Père:</label>
                            <div class="col-sm-9">
                                <input type="text" id="travail_pere" name="travail_pere" class="form-control">
                                @error('travail_pere')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="travail_mere" class="col-sm-3 col-form-label">Travail de la Mère:</label>
                            <div class="col-sm-9">
                                <input type="text" id="travail_mere" name="travail_mere" class="form-control">
                                @error('travail_mere')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="vaccin" class="col-sm-3 col-form-label">Vaccin:</label>
                            <div class="col-sm-9">
                                <input type="text" id="vaccin" name="vaccin" class="form-control">
                                @error('vaccin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="adresse" class="col-sm-3 col-form-label">Adresse:</label>
                            <div class="col-sm-9">
                                <input type="text" id="adresse" name="adresse" class="form-control">
                                @error('adresse')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="maladie" class="col-sm-3 col-form-label">Maladie:</label>
                            <div class="col-sm-9">
                                <input type="text" id="maladie" name="maladie" class="form-control">
                                @error('maladie')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-sm-3 col-form-label">Description:</label>
                            <div class="col-sm-9">
                                <textarea id="description" name="description" class="form-control"></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
