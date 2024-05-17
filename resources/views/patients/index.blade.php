@extends('layouts.panel')

@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('/patientes/create')}}" class="btn btn-sm btn-primary">Nuevo paciente</a>
            </div>
        </div>
    </div>
    <!-- <div class="card-body">
        @if(session('notification'))
        <div class="alert alert-success" role="alert">
            {{session('notification')}}
        </div>
        @endif
    </div> -->
    <div class="table-responsive">
        <!--Projects Table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Fecha de cita</th>
                    <th scope="col">Alergias</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <th scope="row">
                        {{$patient->nombres}}
                    </th>
                    <td>
                        {{$patient->apellidos}}
                    </td>
                    <td>
                        {{$patient->correo}}
                    </td>
                    <td>
                        {{$patient->telefono}}
                    </td>
                    <td>
                        {{$patient->especialidad}}
                    </td>
                    <td>
                        {{$patient->cita}}
                    </td>
                    <td>
                        {{$patient->alergias}}
                    </td>
                    <td>
                        <a href="{{url('/pacientes/'.$patient->id_paciente.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
