@extends('enfant.app')

@section('content')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mt-5 mb-4">Carte de Présence pour Enfants</h1>
            <form action="{{ route('enfant.presence') }}" method="post">
                @csrf
                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Enfant</th>
                                <th>Présence</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($enfants as $enfant)
    <tr>
        <td>{{ $enfant->nom }}</td>
        <td>
            <input type="hidden" name="enfants[]" value="{{ $enfant->id }}">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="present_{{ $enfant->id }}" name="presence_status[{{ $enfant->id }}]" value="present">
                <label class="form-check-label" for="present_{{ $enfant->id }}">Présent</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="absent_{{ $enfant->id }}" name="presence_status[{{ $enfant->id }}]" value="absent">
                <label class="form-check-label" for="absent_{{ $enfant->id }}">Absent</label>
            </div>
        </td>
    </tr>
@endforeach

                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
    </div>
</div>
@endsection