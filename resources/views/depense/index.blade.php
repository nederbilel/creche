@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #ffffff">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste des Dépenses</li>
    </ol>
</nav>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col">
                    <h1>Liste des Dépenses</h1>
                </div>
                <div class="col-auto">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addExpenseModal" style="background-color: #2e90d6;width:100px">
                        Ajouter
                    </button>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @foreach ($depenses as $month => $expenses)
                        <div class="card mb-3">
                            <div class="card-header">{{ \Carbon\Carbon::createFromFormat('m', $month)->locale('fr')->isoFormat('MMMM') }}</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($expenses as $expense)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>{{ $expense['type'] }}</div>
                                        <div>{{ $expense['prix'] }} dt</div>
                                        <div>{{ $expense['date'] }}</div>
                                        <div>{{ $expense['description'] }}</div>
                                        <div>
                                            <button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#editExpenseModal{{ $expense['id'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $expense->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalLabel" aria-hidden="true" @if($errors->any() && $errors->has('type', 'date', 'prix', 'description')) style="display: block;" @endif>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpenseModalLabel">Nouvelle Dépense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('depenses.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type de dépense</label>
                        <select name="type" class="form-control" required>
                            <option value="Cuisine">Cuisine</option>
                            <option value="Steg-Sonede">Steg + Sonede</option>
                            <option value="Louer">Louer</option>
                            <option value="Comptable">Comptable</option>
                            <option value="Cnss">Cnss</option>
                            <option value="Animatrice">Animatrice</option>
                            <option value="Autre">Autre</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date de dépense :</label>
                        <input type="date" name="date" class="form-control" required>
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="valeur">Montant :</label>
                        <input type="number" name="prix" class="form-control" placeholder="prix en dt" required>
                        @error('prix')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" name="description" class="form-control" placeholder="description">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Expense Modals -->
@foreach ($depenses as $expenses)
    @foreach ($expenses as $expense)
        <div class="modal fade" id="editExpenseModal{{ $expense['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editExpenseModalLabel{{ $expense['id'] }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExpenseModalLabel{{ $expense['id'] }}">Modifier Dépense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('depenses.update', $expense['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="type">Type de dépense</label>
                                <select name="type" class="form-control" required>
                                    <option value="Cuisine">Cuisine</option>
                                    <option value="Steg-Sonede">Steg + Sonede</option>
                                    <option value="Louer">Louer</option>
                                    <option value="Comptable">Comptable</option>
                                    <option value="Cnss">Cnss</option>
                                    <option value="Animatrice">Animatrice</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date de dépense :</label>
                                <input type="date" name="date" class="form-control" value="{{ $expense['date'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="valeur">Montant :</label>
                                <input type="number" name="prix" class="form-control" placeholder="prix en dt" value="{{ $expense['prix'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <input type="text" name="description" class="form-control" placeholder="description" value="{{ $expense['description'] }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

<!-- Delete Expense Modals -->
<!-- Delete Expense Modals -->
@foreach ($depenses as $expenses)
    @foreach ($expenses as $expense)
        <div class="modal fade" id="deleteModal{{ $expense['id'] }}" tabindex="-1" role="dialog" aria-labelledby="deleteExpenseModal{{ $expense['id'] }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteExpenseModal{{ $expense['id'] }}">Confirmer la suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cette dépense ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <!-- Form to handle the actual delete action -->
                        <form method="POST" action="{{ route('depenses.destroy', $expense['id']) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirmer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach


@endsection
