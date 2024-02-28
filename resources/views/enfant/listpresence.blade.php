@extends('enfant.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mt-5 mb-4">Liste de présence</h1>
            <div class="mb-4">
                <form action="{{ route('enfant.presence.list') }}" method="get" class="form-inline">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <label for="year" class="mr-2">Année:</label>
                            <select class="form-control form-control-sm custom-select" id="year" name="year" style="width: 100px;">
                                @for ($i = date('Y') - 5; $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}" @if ($year == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="month" class="mr-2">Mois:</label>
                            <select class="form-control form-control-sm custom-select" id="month" name="month" style="width: 100px;">
                                @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" @if ($month == $i) selected @endif>{{ \Carbon\Carbon::create()->month($i)->locale('fr_FR')->isoFormat('MMMM') }}</option>
                                @endfor
                            </select>
                        </div>
                       
                        <div class="col-auto">
                            <label for="enfant" class="mr-2">Enfant:</label>
                            <select class="form-control form-control-sm custom-select" id="enfant" name="enfant" style="width: 150px;">
                                @foreach ($enfants as $enfant)
                                <option value="{{ $enfant->id }}" @if ($enfantId == $enfant->id) selected @endif>{{ $enfant->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                        </div>
                    </div>
                </form>
                <div class="col-auto">
                    <a href="{{ route('enfant.presence.pdf', ['enfant' => $enfantId, 'year' => $year, 'month' => $month]) }}" class="btn btn-success btn-sm" target="_blank">Imprimer</a>
                </div>
                
            </div>
            <div class="calendar">
                <div class="row">
                    @for ($day = 1; $day <= 31; $day++)
                    @php
                    $date = \Carbon\Carbon::createFromDate($year, $month, $day);
                    $presenceOfDay = $presences->firstWhere('date', $date->format('Y-m-d'));
                    $monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'][$month - 1];
                    @endphp
                    <div class="col-md-2">
                        <div class="day">
                            <div class="date">
                                {{ $day }} {{ $monthName }} {{ $year }}
                            </div>
                            <div class="presence" style="color: {{ $presenceOfDay && $presenceOfDay->presence === 'present' ? 'green' : 'red' }}">
                                @if ($presenceOfDay)
                                {{ $presenceOfDay->presence }}
                                @else
                                -
                                @endif
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
