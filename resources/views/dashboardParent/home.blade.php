@extends('parent.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="text-center">Bienvenue dans votre espace parent</h1>
        </div>
        <div class="card-body">
            @if($enfant)
                <div class="alert alert-info">
                    <strong>Nom de votre enfant :</strong> {{ $enfant->nom }}
                </div>
            @endif

            @php
                // Ensure Carbon uses French locale
                \Carbon\Carbon::setLocale('fr');
                $currentMonth = \Carbon\Carbon::now()->month;
                $currentYear = \Carbon\Carbon::now()->year;
                $lastPaidMonth = null;
                $lastPaidYear = null;

                if ($paiements->isNotEmpty()) {
                    // Find the most recent payment
                    $latestPaiement = $paiements->sortByDesc(function ($paiement) {
                        return $paiement->annee * 100 + $paiement->mois;
                    })->first();
                    $lastPaidMonth = $latestPaiement->mois;
                    $lastPaidYear = $latestPaiement->annee;

                    // Check for unpaid months between the last paid month and the current month
                    $unpaidMonths = [];
                    if ($lastPaidMonth && $lastPaidYear) {
                        $start = \Carbon\Carbon::create($lastPaidYear, $lastPaidMonth, 1);
                        $end = \Carbon\Carbon::now()->startOfMonth();

                        while ($start->lessThanOrEqualTo($end)) {
                            if (!$paiements->contains(function ($paiement) use ($start) {
                                return $paiement->mois == $start->month && $paiement->annee == $start->year;
                            })) {
                                $unpaidMonths[] = $start->copy();
                            }
                            $start->addMonth();
                        }
                    }
                } else {
                    // If no payments have been made, set the unpaid months array
                    $unpaidMonths = [];
                }
            @endphp

            @if(empty($paiements))
                <div class="alert alert-warning">
                    Aucun paiement enregistré pour cet enfant.
                </div>
            @elseif(!empty($unpaidMonths))
                <div class="alert alert-danger">
                    <strong>Attention !</strong> Les mois suivants n'ont pas encore été payés :
                    <ul>
                        @foreach($unpaidMonths as $month)
                            <li>{{ $month->translatedFormat('F Y') }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($paiements->isNotEmpty())
                <h2 class="mt-4">Liste des mois payés</h2>
                <table class="table table-striped mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mois</th>
                            <th>Année</th>
                            <th>Montant</th>
                            <th>Date de paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                            <tr>
                                <td>{{ \Carbon\Carbon::create()->month($paiement->mois)->translatedFormat('F') }}</td>
                                <td>{{ $paiement->annee }}</td>
                                <td>{{ number_format($paiement->valeur, 2) }} Dinars</td>
                                <td>{{ \Carbon\Carbon::parse($paiement->date)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
