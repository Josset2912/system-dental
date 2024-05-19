@extends('layouts.panel')
@section('styles')
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">

@endsection

@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('crearPaciente.index')}}" class="btn btn-sm btn-primary">Nuevo Paciente</a>
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
    <div class="row m-3">
        <div class="table-responsive">
            <!--Projects Table -->
            <table class="table align-items-center table-flush"  id="myTable">
                <thead class="thead-light">
                    <tr>
                        <!-- <th scope="col">Id Paciente</th> -->
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Alergias</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Nombre:</strong> <span id="nombrePaciente"></span></p>
        <p><strong>Correo:</strong> <span id="correoPaciente"></span></p>
        <p><strong>Teléfono:</strong> <span id="telefonoPaciente"></span></p>
        <p><strong>Especialidad:</strong> <span id="especialidadPaciente"></span></p>
        <p><strong>Alergias:</strong> <span id="alergiasPaciente"></span></p>
        <p><strong>Observaciones:</strong> <span id="observacionesPaciente"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



@endsection


<script>
    window.onload = function() {
        $('#myTable').DataTable( {
            ajax: "{{ route('pacientes.index') }}",
            columns: [
                { data: 'nombres' },
                { data: 'apellidos' },
                { data: 'correo' },
                { data: 'telefono' },
                { data: 'especialidad' },
                { data: 'alergias' },
                { data: 'observaciones' },
                { data: 'acciones' }
            ],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            processing: true,
        } );

        $(document).on('click', '.levantarModal', function() {
            var data = $('#myTable').DataTable().row($(this).parents('tr')).data();
            $('#nombrePaciente').text(data.nombres + ' ' + data.apellidos);
            $('#correoPaciente').text(data.correo);
            $('#telefonoPaciente').text(data.telefono);
            $('#especialidadPaciente').text(data.especialidad);
            $('#alergiasPaciente').text(data.alergias);
            $('#observacionesPaciente').text(data.observaciones);
            $('#exampleModal').modal('show');
        });
    };
</script>


