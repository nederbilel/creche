@extends('enfant.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Profil</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('updatemember') }}" method="POST">
        @csrf

        <!-- Nom -->
        <div class="form-group">
            <label for="name">Nom et Prénom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <label for="password">Mot de passe (laisser vide pour conserver le mot de passe actuel)</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
    </form>
</div>
@endsection
