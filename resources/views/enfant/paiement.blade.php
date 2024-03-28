@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb" style="background-color: #ffffff">
    <li class="breadcrumb-item"><a href="/home" style="color :#368062">Home</a></li>
    <li class="breadcrumb-item"><a href="/paiementList" style="color :#368062">Paiement Assurences</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Nouvel Paiement</li>
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
        <div class="col-md-10">
            <h1>Nouvel Paiement Assurence</h1>
            <form action="{{ route('enfant.paiement.submit') }}" method="POST">
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
                    <label for="date">Date:</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="valeur">Valeur:</label>
                    <input type="number" name="valeur" class="form-control">
                </div>
                <div class="form-group">
                    <label for="annee">Année:</label>
                    <input type="text" name="annee" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
