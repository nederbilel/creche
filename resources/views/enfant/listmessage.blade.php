@extends('enfant.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: #f8f9fa;">
        <li class="breadcrumb-item"><a href="/home" style="color: #2e90d6;">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Messages</li>
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
    <h2 class="mb-4">Vos Messages</h2>

    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('message.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col">
                <input type="date" name="start_date" class="form-control" placeholder="Date de début" value="{{ request('start_date') }}">
            </div>
            <div class="col">
                <input type="date" name="end_date" class="form-control" placeholder="Date de fin" value="{{ request('end_date') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <a href="{{ route('message.index') }}" class="btn btn-secondary">Effacer le filtre</a>
            </div>
        </div>
    </form>

    @if ($messages->isEmpty())
        <div class="alert alert-info">
            Vous n'avez aucun message pour le moment.
        </div>
    @else
        <div class="list-group">
            @foreach ($messages as $message)
                <a href="{{ route('messages.show', $message->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 font-weight-bold">{{ $message->nom }} {{ $message->prenom }}</h5>
                        <small class="text-muted">{{ $message->created_at->format('d M, Y h:i A') }}</small>
                    </div>
                    <p class="mb-1 text-truncate">{{ Str::limit($message->message, 100) }}</p>
                    <small class="text-muted">Email : {{ $message->email }}</small>
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection
