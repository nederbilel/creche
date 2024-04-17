@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #f8f9fa;">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6;">Home</a></li>
        <li class="breadcrumb-item"><a href="/paiementList" style="color: #2e90d6;">Dépenses</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nouvel depense</li>
    </ol>
</nav>

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Nouvel Dépense</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('depenses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type de dépense</label>
                            <select name="type" class="form-control">
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
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="valeur">Montant :</label>
                            <input type="number" name="prix" class="form-control" placeholder="prix en dt">
                        </div>
                        <div class="form-group">
                            <label for="annee">Description :</label>
                            <input type="text" name="description" class="form-control" placeholder="description">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
