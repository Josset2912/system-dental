@extends('layouts.panel')

@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Nuevo Paciente</h3>
            </div>
            <div class="col text-right">
                <a href="{{url('/pacientes')}}" class="btn btn-sm btn-success">
                    <i class="fas fa-chevron-left"></i>
                    Regresar</a>
            </div>
        </div>
    </div>
    <!--Projects Table -->
    <div class="card-body">
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Por favor!!!</strong> {{$error}}
        </div>
        @endforeach
        @endif


        <form action="{{url('/pacientes')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombres">Nombre del Paciente</label>
                <input type="text" name="nombres" class="form-control" value="{{old('nombres')}}" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellido</label>
                <input type="text" name="apellidos" class="form-control" value="{{old('apellidos')}}">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}">
            </div>

            <div class="form-group">
                <label for="correo">Email</label>
                <input type="text" name="correo" class="form-control" value="{{old('correo')}}">
            </div>

            <div class="form-group">
                <label for="telefono">Celular</label>
                <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}">
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" value="{{old('especialidad')}}">
            </div>

            <div class="form-group">
                <label for="cita">Fecha de la Cita</label>
                <input type="text" name="cita" class="form-control" value="{{old('cita')}}">
            </div>

            <div class="form-group">
                <label for="alergias">Alergias</label>
                <input type="text" name="alergias" class="form-control" value="{{old('alergias')}}">
            </div>

            <div class="form-group">
                <label for="obervaciones">Observaciones</label>
                <input type="text" name="obervaciones" class="form-control" value="{{old('obervaciones')}}">
            </div>



            <button type="submit" class="btn btn-sm btn-primary ">Crear Paciente</button>
        </form>
    </div>
</div>
@endsection
