@extends('enfant.app')

@section('content')
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb" style="background-color: #ffffff">
            <li class="breadcrumb-item active" aria-current="page">Home</a></li>
            
        </ol>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
 
            </div>
        </div>
    </div>
@endsection
