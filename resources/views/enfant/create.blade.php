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
            <form id="enfantForm" method="POST" action="{{ route('enfants.store') }}" enctype="multipart/form-data">
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
                        <label for="nom" class="form-label">Nom et Prenom</label>
                        <input type="text" id="nom" name="nom" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('nom') }}">
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="date_de_naissance" class="form-label">Date de Naissance</label>
                        <input type="date" id="date_de_naissance" name="date_de_naissance" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('date_de_naissance') }}">
                        @error('date_de_naissance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="maladie" class="form-label">Maladie</label>
                        <input type="text" id="maladie" name="maladie" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('maladie') }}">
                        @error('maladie')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="vaccin" class="form-label">Vaccin</label>
                        <input type="text" id="vaccin" name="vaccin" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('vaccin') }}">
                        @error('vaccin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="sexe" class="form-label">Sexe</label>
                        <select class="form-control" id="sexe" name="sexe" required>
                            <option value="Garçon" {{ old('sexe') == 'Garçon' ? 'selected' : '' }}>Garçon</option>
                            <option value="Fille" {{ old('sexe') == 'Fille' ? 'selected' : '' }}>Fille</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('adresse') }}">
                        @error('adresse')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="toute_journee" name="toute_journee" value="true" class="form-check-input" {{ old('toute_journee') ? 'checked' : '' }}>
                            <label class="form-check-label" for="toute_journee">Toute la journée</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="avec_gouter" name="avec_gouter" value="true" class="form-check-input" {{ old('avec_gouter') ? 'checked' : '' }}>
                            <label class="form-check-label" for="avec_gouter">Avec Goûter</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="Demi-journée" name="Demi-journée" value="true" class="form-check-input" {{ old('Demi-journée') ? 'checked' : '' }}>
                            <label class="form-check-label" for="Demi-journée">Demi-journée</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input type="checkbox" id="sans_gouter" name="sans_gouter" value="true" class="form-check-input" {{ old('sans_gouter') ? 'checked' : '' }}>
                            <label class="form-check-label" for="sans_gouter">Sans Goûter</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="frais_inscription" class="form-label">Frais d'inscription</label>
                        <input type="text" id="frais_inscription" name="frais_inscription" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('frais_inscription') }}">
                        @error('frais_inscription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <h4 class="text-decoration-underline fst-italic">Information Parents</h4>
                <div class="row mb-3" style="margin-top: 30px">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="nom_mere" class="form-label">Nom de la Mère</label>
                            <input type="text" id="nom_mere" name="nom_mere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('nom_mere') }}">
                            @error('nom_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="telephone1" class="form-label">Téléphone de la mère</label>
                            <input type="text" id="telephone1" name="telephone1" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('telephone1') }}">
                            @error('telephone1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="travail_mere" class="form-label">Travail de la Mère</label>
                            <input type="text" id="travail_mere" name="travail_mere" class="form-control rounded-0 border-bottom-0 border-top-0 border-left-0.5 border-right-0" value="{{ old('travail_mere') }}">
                            @error('travail_mere')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="nom_pere" class="form-label">Nom du Père</label>
                        <input type="text" id="nom_pere" name="nom_pere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('nom_pere') }}">
                        @error('nom_pere')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="telephone2" class="form-label">Téléphone du Père</label>
                        <input type="text" id="telephone2" name="telephone2" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('telephone2') }}">
                        @error('telephone2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="travail_pere" class="form-label">Travail du Père</label>
                        <input type="text" id="travail_pere" name="travail_pere" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0" value="{{ old('travail_pere') }}">
                        @error('travail_pere')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 text-center">
                    <div class="col">
                        <button type="button" onclick="validateForm()" class="btn btn-primary" style="background-color: #2e90d6; width: 300px;">Enregistrer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var touteJourneeCheckbox = document.getElementById('toute_journee');
        var demiJourneeCheckbox = document.getElementById('Demi-journée');
        var avec_gouterCheckbox = document.getElementById('avec_gouter');
        var sans_gouterCheckbox = document.getElementById('sans_gouter');

        touteJourneeCheckbox.addEventListener('change', function() {
            if (touteJourneeCheckbox.checked) {
                demiJourneeCheckbox.checked = false;
            }
        });

        demiJourneeCheckbox.addEventListener('change', function() {
            if (demiJourneeCheckbox.checked) {
                touteJourneeCheckbox.checked = false;
            }
        });

        sans_gouterCheckbox.addEventListener('change', function() {
            if (sans_gouterCheckbox.checked) {
                avec_gouterCheckbox.checked = false;
            }
        });

        avec_gouterCheckbox.addEventListener('change', function() {
            if (avec_gouterCheckbox.checked) {
                sans_gouterCheckbox.checked = false;
            }
        });
    });

    function validateForm() {
        var form = document.getElementById('enfantForm');
        var inputs = form.querySelectorAll('input[required], select[required]');
        var valid = true;

        inputs.forEach(function(input) {
            if (!input.value) {
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (valid) {
            form.submit();
        } else {
            alert('Please fill out all required fields.');
        }
    }
</script>
@endsection
