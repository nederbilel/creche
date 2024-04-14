@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Paiements Mensuel</li>
    </ol>
</nav>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <div class="row justify-content-between align-items-center mb-3">
                <div class="col">
                    <h1>Liste des Paiements</h1>
                </div>
                <div class="col-auto">
                    <!-- Button to trigger the modal -->
                    <a id="ajouterPaiementMoisBtn" class="btn btn-success" href="#" style="background-color: #2e90d6;width:100px" data-toggle="modal" data-target="#ajouterPaiementMoisModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mb-3">
                <label for="year-filter" class="form-label">Sélectionnez l'année :</label>
                <select class="form-select" id="year-filter" onchange="filterPayments(this.value)">
                    <option value="">Toutes les années</option>
                    @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div id="paiements-container">
                @foreach($paiements as $year => $paiementsByYear)
                @foreach($paiementsByYear as $mois => $paiementsByMois)
                <div class="year-month" data-year="{{ $year }}" data-month="{{ $mois }}">
                    <h3>Paiements pour {{ $mois }}</h3>
                    <table class="table">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th scope="col">Nom Enfant</th>
                                <th scope="col">Date de paiement</th>
                                <th scope="col">Année</th>
                                <th scope="col">Valeur</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @foreach($paiementsByMois as $paiement)
                            <tr>
                                <td>{{ $paiement->enfant->nom }}</td>
                                <td>{{ $paiement->date }}</td>
                                <td>{{ $paiement->annee }}</td>
                                <td>{{ $paiement->valeur }}</td>
                                <td>
                                    <!-- Actions buttons -->
                                    <a href="{{ route('enfant.editpaiementmois', $paiement->id) }}" class="btn btn-primary">Modifier</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $paiement->id }}">Supprimer</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce paiement ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('enfant.destroypaiementmois', $paiement->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding a new payment month -->
<div class="modal fade" id="ajouterPaiementMoisModal" tabindex="-1" role="dialog" aria-labelledby="ajouterPaiementMoisModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterPaiementMoisModalLabel">Ajouter paiement mois</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include the form for adding a new payment month here -->
                <!-- You can include the form you provided in your second code snippet -->
                <form action="{{ route('enfant.paiementmois.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom_enfant">Nom Enfant:</label>
                        <select name="enfant_id" class="form-control">
                            @foreach($enfants as $enfant)
                                <option value="{{ $enfant->id }}">{{ $enfant->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date de paiement:</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="valeur">Valeur:</label>
                        <input type="number" name="valeur" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="valeur">Année:</label>
                        <input type="number" name="annee" class="form-control">
                    </div>
                
                    <div class="form-group">
                        <label for="mois">Mois :</label>
                        <select class="form-control" id="mois" name="mois" required>
                            <option value="">Sélectionner un mois</option>
                            <option value="Janvier">Janvier</option>
                            <option value="Février">Février</option>
                            <option value="Mars">Mars</option>
                            <option value="Avril">Avril</option>
                            <option value="Mai">Mai</option>
                            <option value="Juin">Juin</option>
                            <option value="Juillet">Juillet</option>
                            <option value="Août">Août</option>
                            <option value="Septembre">Septembre</option>
                            <option value="Octobre">Octobre</option>
                            <option value="Novembre">Novembre</option>
                            <option value="Décembre">Décembre</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function filterPayments(year) {
        var rows = document.querySelectorAll('.year-month');
        rows.forEach(row => {
            var rowYear = row.getAttribute('data-year');
            if (year === '' || rowYear === year) {
                row.style.display = 'block';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
