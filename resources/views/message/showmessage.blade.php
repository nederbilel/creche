@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #f8f9fa;">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6;">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('message.index') }}" style="color: #2e90d6;">Messages</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $message->nom }} {{ $message->prenom }}</li>
    </ol>
</nav>

<div class="container">
    <h2 class="mb-4">Détails du Message</h2>

    <div class="card">
        <div class="card-header">
            <strong>De :</strong> {{ $message->nom }} {{ $message->prenom }}<br>
            <strong>Email :</strong> {{ $message->email }}<br>
            <strong>Reçu le :</strong> {{ $message->created_at->format('d M, Y h:i A') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Message</h5>
            <p class="card-text">{{ $message->message }}</p>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('message.index') }}" class="btn btn-primary">Retour aux Messages</a>
        </div>
    </div>
</div>

@endsection
