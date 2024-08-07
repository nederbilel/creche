@extends('enfant.app')

@section('content')



<nav aria-label="breadcrumb">
<ol class="breadcrumb" style="background-color: #ffffff">
    <li class="breadcrumb-item"><a href="/home" style="color :#2e90d6">Home</a></li>
    <li class="breadcrumb-item"><a href="/paiementmoisList" style="color :#2e90d6">Paiement Mensuel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nouvel paiement</li>
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
            <h1>Nouvel Paiement </h1>
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
                        <option value="">Select a month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
