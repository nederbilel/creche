@extends('enfant.app')

@section('content')
<!-- Begin Page Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Genération du rapport</a> --}}
    </div>
   
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                dépense (mensuels)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$recentMonthExpenses}}  </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                revenu (mensuels)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalFees}} dt</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pourcentage d'enfants payés ce mois
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$percentagePaidEnfants}}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{$percentagePaidEnfants}}%;" aria-valuenow="{{$percentagePaidEnfants}}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Nombre d'enfants</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countAllEnfants}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row my-2">
        
        <div class="col-md-3 py-1">
            <div class="card">
                <div class="card-body">
                    <canvas id="chDonut1"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-3 py-1">
            <div class="card">
                <div class="card-header">
                    Enfants non payés ce mois
                </div>
                <div class="card-body">
                    @if ($enfantsNotPaid->isEmpty())
                        <p class="text-muted">Tous les enfants ont payé ce mois-ci.</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($enfantsNotPaid as $enfant)
                                <li class="mb-2"><i class="bi bi-person mr-1"></i>{{ $enfant->nom }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        


        <script>

var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

var chLine = document.getElementById("chLine");
var chartData = {
  labels: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
  datasets: [{
    data: [, 6, 8, 9, 7, 6, 7],
    backgroundColor: 'transparent',
    borderColor: colors[0],
    borderWidth: 3,
    pointBackgroundColor: colors[0]
  }]
};

if (chLine) {
  new Chart(chLine, {
    type: 'line',
    data: chartData,
    options: {
      scales: {
        y: {
          ticks: {
            beginAtZero: true
          }
        },
        x: {
          ticks: {
            beginAtZero: true
          }
        }
      },
      legend: {
        display: false
      },
      responsive: true
    }
  });
}



var donutOptions = {
  cutoutPercentage: 85, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

var chDonutData1 = {
    labels: ['garçons', 'filles'],
    datasets: [
      {
        backgroundColor: colors.slice(3,7),
        borderWidth: 0,
        data: [<?php echo $countboys; ?>, <?php echo $countgirls; ?>]
      }
    ]
};


var chDonut1 = document.getElementById("chDonut1");
if (chDonut1) {
  new Chart(chDonut1, {
      type: 'pie',
      data: chDonutData1,
      options: donutOptions
  });
}



// 




        </script>
 








@endsection
