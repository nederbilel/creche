@extends('enfant.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<style>
.custom-btn {
    /* Add your custom styles here */
    border-radius: 8px;
    font-size: 16px;
    padding: 5px 10px; /* Adjust padding for smaller buttons */
    width: auto; /* Set width to auto for smaller buttons */
}

.custom-btn:hover {
    /* Add hover styles if needed */
    background-color: #e0e0e0;
}

</style>
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

{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <div class="row justify-content-between align-items-center mb-3">
                <div class="col">
                    <h1>Liste des factures</h1>
                </div>
                <div class="col-auto">
                    <!-- Button to trigger the modal -->
                    <a id="ajouterPaiementMoisBtn" class="btn btn-success" href="#" style="background-color: #2e90d6;width:200px" data-toggle="modal" data-target="#ajouterPaiementMoisModal">nouvel paiement
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="year-filter" class="form-label">Sélectionnez l'année :</label>
                        <select class="form-select" id="year-filter" onchange="filterPayments(this.value, document.getElementById('month-filter').value)" style="width: 50%;">
                            <option value="">Toutes les années</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="month-filter" class="form-label">Sélectionnez le mois :</label>
                        <select class="form-select" id="month-filter" onchange="filterPayments(document.getElementById('year-filter').value, this.value)" style="width: 50%;">
                            <option value="">Tous les mois</option>
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </div>
                </div>
            </div>
            
            

            <div id="paiements-container">
                @foreach($paiements as $year => $paiementsByYear)
                @foreach($paiementsByYear as $mois => $paiementsByMois)
                <div class="year-month" data-year="{{ $year }}" data-month="{{ $mois }}">
                    <h3>Paiements pour {{ \Carbon\Carbon::createFromFormat('m', $mois)->locale('fr')->isoFormat('MMMM') }}</h3>
                    <table class="table">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th scope="col">Nom Enfant</th>
                                <th scope="col">Date de paiement</th>
                                {{-- <th scope="col">Année</th> --}}
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
                                {{-- <td>{{ $paiement->annee }}</td> --}}
                                <td>{{ $paiement->valeur }}</td>
                                <td>
                                    <a href="{{ route('enfant.editpaiementmois', $paiement->id) }}" class="btn btn-primary custom-btn">
                                        <i class="bi bi-pencil-fill"></i> Modifier
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger custom-btn" data-toggle="modal" data-target="#deleteModal{{ $paiement->id }}">
                                        <i class="bi bi-trash-fill"></i> Supprimer
                                    </button>
                                    
                                    <a href="{{ route('enfant.paiement.pdf', ['enfant' => $paiement->enfant_id, 'year' => $paiement->annee, 'month' => $paiement->mois]) }}" class="btn btn-success btn-sm custom-btn" target="_blank">
                                        <i class="bi bi-printer-fill"></i> Imprimer
                                    </a>
                                    
                                    
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
<!-- Error Messages (outside the modal) -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

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
                <!-- Error Messages (inside the modal) -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Payment Form -->
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
                        <label for="valeur">Mois :</label>
                        <select class="form-control" id="mois" name="mois" required>
                            <option value="">Sélectionner un mois</option>
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#ajouterPaiementMoisModal').modal('show');
    });
</script>
@endif

@endsection

<script>
    function filterPayments(year, month) {
        var rows = document.querySelectorAll('.year-month');
        rows.forEach(row => {
            var rowYear = row.getAttribute('data-year');
            var rowMonth = row.getAttribute('data-month');
            // If both year and month are selected, compare them as numbers
            if (year !== '' && month !== '') {
                if (parseInt(rowYear) === parseInt(year) && parseInt(rowMonth) === parseInt(month)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            }
            // If only year is selected, filter by year
            else if (year !== '' && month === '') {
                if (parseInt(rowYear) === parseInt(year)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            }
            // If only month is selected, filter by month
            else if (year === '' && month !== '') {
                if (parseInt(rowMonth) === parseInt(month)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            }
            // If no filters are selected, display all rows
            else {
                row.style.display = 'block';
            }
        });
    }
    
    $(document).ready(function() {
        console.log("Document is ready.");
        @if ($errors->any())
        console.log("Errors found. Showing modal...");
        $('#ajouterPaiementMoisModal').modal('show');
        @endif
    });

</script>


