@extends('enfant.app')
   {{-- @if ($errors->any())
   <div style="margin-left:200px;margin-top:100px;">

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</div>
        @endforeach
    </ul>
</div>
</div>
@endif  --}}

@section('content')

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
                        <label class="form-label">Vaccin</label>
                        <div>
                            <input type="radio" id="vaccin_oui" name="vaccin_radio" value="oui" {{ old('vaccin_radio') == 'oui' ? 'checked' : '' }}> Oui
                            <input type="radio" id="vaccin_no" name="vaccin_radio" value="no" {{ old('vaccin_radio') == 'no' ? 'checked' : '' }}> Non
                        </div>
                        <input type="text" id="vaccin_detail" name="vaccin" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0 mt-2" value="{{ old('vaccin') }}" style="display: none;">
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

                <div class="row mb-3">

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="caret_enfant" class="form-label">Carnet Enfant </label>
                            <input type="file" id="caret_enfant" name="caret_enfant" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                            @error('caret_enfant')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="cin_parent" class="form-label">CIN Parent </label>
                            <input type="file" id="cin_parent" name="cin_parent" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                            @error('cin_parent')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="certif_enfant" class="form-label">Certif Enfant </label>
                            <input type="file" id="certif_enfant" name="certif_enfant" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                            @error('certif_enfant')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="extrait_de_naissance" class="form-label">Extrait de Naissance </label>
                            <input type="file" id="extrait_de_naissance" name="extrait_de_naissance" class="form-control rounded-0 border-bottom border-top-0 border-left-0.5 border-right-0">
                            @error('extrait_de_naissance')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    
                </div>
                
                <!-- Ajouter le champ Extrait_de_naissance -->
              


                <div class="row mb-3">
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
                            <label for="nom_mere" class="form-label">Nom et Prenom de la Mère</label>
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
                        <label for="nom_pere" class="form-label">Nom et prenom du Père</label>
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
        var vaccinOuiRadio = document.getElementById('vaccin_oui');
        var vaccinNoRadio = document.getElementById('vaccin_no');
        var vaccinDetailInput = document.getElementById('vaccin_detail');

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

        vaccinOuiRadio.addEventListener('change', function() {
            if (vaccinOuiRadio.checked) {
                vaccinDetailInput.style.display = 'block';
                vaccinDetailInput.required = true;
                vaccinDetailInput.name = 'vaccin';
            }
        });

        vaccinNoRadio.addEventListener('change', function() {
            if (vaccinNoRadio.checked) {
                vaccinDetailInput.style.display = 'none';
                vaccinDetailInput.required = false;
                vaccinDetailInput.name = 'vaccin';
                vaccinDetailInput.value = 'non';
            }
        });

        // Show or hide the vaccin detail input based on the old value
        if (vaccinOuiRadio.checked) {
            vaccinDetailInput.style.display = 'block';
            vaccinDetailInput.required = true;
        } else if (vaccinNoRadio.checked) {
            vaccinDetailInput.style.display = 'none';
            vaccinDetailInput.required = false;
            vaccinDetailInput.value = 'non';
        } else {
            vaccinDetailInput.style.display = 'none';
            vaccinDetailInput.required = false;
        }
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

        // Ensure the vaccin field is correctly handled
        var vaccinOuiRadio = document.getElementById('vaccin_oui');
        var vaccinNoRadio = document.getElementById('vaccin_no');
        var vaccinDetailInput = document.getElementById('vaccin_detail');
        
        if (vaccinOuiRadio.checked) {
            vaccinDetailInput.name = 'vaccin';
        } else if (vaccinNoRadio.checked) {
            vaccinDetailInput.name = 'vaccin';
            vaccinDetailInput.value = 'non';
        }

        if (valid) {
            form.submit();
        } else {
            alert('Please fill out all required fields.');
        }
    }
</script>
@endsection
