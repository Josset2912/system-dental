@extends('layouts.panel')

@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('/pacientes/create')}}" class="btn btn-sm btn-primary">Nuevo Paciente</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(session('notification'))
        <div class="alert alert-success" role="alert">
            {{session('notification')}}
        </div>
        @endif
    </div>
    <div class="table-responsive">
        <!--Projects Table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id Paciente</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Alergias</th>
                    <th scope="col">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $paciente)
                <tr>
                    <th scope="row">
                        {{$paciente->id_paciente}}
                    </th>
                    <th>
                        {{$paciente->nombres}}
                    </th>
                    <td>
                        {{$paciente->apellidos}}
                    </td>
                    <td>
                        {{$paciente->direccion}}
                    </td>
                    <td>
                        {{$paciente->correo}}
                    </td>
                    <td>
                        {{$paciente->telefono}}
                    </td>
                    <td>
                        {{$paciente->especialidad}}
                    </td>
                    <td>
                        {{$paciente->cita}}
                    </td>
                    <td>

                        <form action="{{url('/pacientes/'.$paciente->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/pacientes/'.$paciente->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection