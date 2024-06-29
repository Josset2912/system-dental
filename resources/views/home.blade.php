@extends('layouts.panel')

@section('content')

<style>
        .card-header {
            color: white;
            font-size: 1.5rem;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius:12px;
        }
        .bg-teal {
            background-color: #20c997 !important;
        }
        .bg-primary {
            background-color: #007bff !important;
        }
        .bg-success {
            background-color: #28a745 !important;
        }
        .card-icon {
            font-size: 2rem;
        }
        .card-imagen1 {
            height: 500px; 
            background-size: cover;
            border-radius:10px;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url("{{asset('img/brand/fondo_home.png')}}")
        }
      
</style>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header text-dark">{{ __('Panel principal') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{ __('Bienvenido!') }}
            </div>
        </div>
    </div>
 
   
    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header bg-teal">
                <div>
                    <h2 class="text-white">Pacientes</h2>
                    <p class="text-white display-1">{{ $patientsCount }}</p>
                </div>
                <i class="card-icon fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <div>
                    <h2 class="text-white">Especialidades</h2>
                    <p class="text-white display-1">1</p>
                </div>
                <i class="card-icon fa fa-archive"></i>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header bg-success">
                <div>
                    <h2 class="text-white">Cotizaciones</h2>
                    <p class="text-white display-1">{{$quotationsCount}}</p>
                </div>
                <i class="card-icon fas fa-calendar"></i>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4 mt-4">
        <div  class="w-100 card-imagen1" > </div>
    </div>
   
</div>
<div class="row mt-5">
   
  
</div>
@endsection