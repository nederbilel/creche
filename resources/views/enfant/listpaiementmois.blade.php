@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color: #368062">Home</a></li>
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
            <div class="mb-3">
                <label for="year-filter" class="form-label">Select Year:</label>
                <select class="form-select" id="year-filter" onchange="filterPayments(this.value)">
                    <option value="">All Years</option>
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
                                    <a href="{{ route('enfant.editpaiementmois', $paiement->id) }}"
                                        class="btn btn-primary">Modifier</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $paiement->id }}">Supprimer</button>
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
