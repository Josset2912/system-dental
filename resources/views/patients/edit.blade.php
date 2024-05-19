@extends('layouts.panel')

@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Editar Paciente</h3>
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

        <input type="text" class="d-none" value="{{ $paciente->id_paciente}}" id="pacienteId" >
        <form id="editForm" name="editForm" method="POST" >
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $paciente->nombres}}" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $paciente->apellidos}}" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ $paciente->correo}}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $paciente->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <input type="text" name="especialidad" id="especialidad" class="form-control" value="{{ $paciente->especialidad}}" required>
            </div>
            <div class="form-group">
                <label for="alergias">Alergias</label>
                <textarea name="alergias" id="alergias" class="form-control" required>{{ $paciente->alergias}}</textarea>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control" required>{{ $paciente->observaciones}}</textarea>
            </div>
            <button  type="submit" id="guardarBtn"  class="btn btn-primary"  data-id="{{ $paciente->id }}">Guardar</button>
        </form>



    </div>
</div>
</div>
@endsection


<script>
  window.onload = function() {
    $('#guardarBtn').click(function(event) {
        event.preventDefault();

        var pacienteId = $('#pacienteId').val();

        var nombres = $('#nombres').val();
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();
        var especialidad = $('#especialidad').val();
        var alergias = $('#alergias').val();
        var observaciones = $('#observaciones').val();

        var formData = {
            _token: "{{ csrf_token() }}",
            _method: "PUT",
            nombres: nombres,
            apellidos: apellidos,
            correo: correo,
            telefono: telefono,
            especialidad: especialidad,
            alergias: alergias,
            observaciones: observaciones
        };

        $.ajax({
            type: 'put',
            url: "{{ route('updatePatient.actualiza', ['valor' => ':id']) }}".replace(':id', pacienteId),
            data: formData,
            success: function(data) {
                window.location.href = "{{url('/pacientes')}}";
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}


</script>