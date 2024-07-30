@extends('layouts.panel')
@section('styles')
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">

@endsection

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


@section('content')


<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0"> Pacientes</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('crearPaciente.index')}}" class="btn btn-sm btn-success">Nuevo Paciente</a>
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
                        <th scope="col">Estado civil</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">motivo</th>
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
        <p><strong>Estado civil:</strong> <span id="estado_civil"></span></p>
        <p><strong>Fecha:</strong> <span id="fecha"></span></p>
        <p><strong>Profesión:</strong> <span id="profesion"></span></p>
        <p><strong>Telefono:</strong> <span id="telefono"></span></p>
        <p><strong>Motivo:</strong> <span id="motivo_consulta"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    window.onload = function() {
        $('#myTable').DataTable( {
            ajax: "{{ route('pacientes.index') }}",
            columns: [
                { data: 'nombres' },
                { data: 'estado_civil' },
                { data: 'fecha' },
                { data: 'profesion' },
                { data: 'telefono' },
                { data: 'motivo_consulta' },
                { data: 'acciones' }
            ],
            language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "_START_ al _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            paginate: {
                first: "<<",
                previous: "<",
                next: ">",
                last: ">>"
            },
            // aria: {
            //     sortAscending: ": Activar para ordenar la columna de manera ascendente",
            //     sortDescending: ": Activar para ordenar la columna de manera descendente"
            // }
        },
            processing: true,
            ordering: false 
        } );

        $(document).on('click', '.levantarModal', function() {
            var data = $('#myTable').DataTable().row($(this).parents('tr')).data();
            $('#nombrePaciente').text(data.nombres );
            $('#estado_civil').text(data.estado_civil);
            $('#fecha').text(data.fecha);
            $('#profesion').text(data.profesion);
            $('#motivo').text(data.motivo);
            $('#telefono').text(data.telefono);
            $('#motivo_consulta').text(data.motivo_consulta);
            $('#exampleModal').modal('show');
        });

        $(document).on('click', '.eliminarPaciente', function() {
            var id = $(this).data('id');
            Swal.fire({
            title: "¿Desea eliminar el paciente?",
            // text: "cuidado",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar"
            }).then((result) => {
            if (result.isConfirmed) {      
                $.ajax({
                    url: '{{ route("eliminarPaciente") }}', // Ruta para eliminar paciente
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // alert('Paciente eliminado exitosamente');
                            Swal.fire({
                            position: "center-end",
                            icon: "success",
                            title: "Eliminado correctamente",
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            // Recargar la página después de que se cierre el Swal
                            setTimeout(function() {
                                $('#myTable').DataTable().ajax.reload();
                            }, 1000); // Puedes ajustar el tiempo de espera si es necesario
                        });

                        } else {
                            alert('Hubo un error al eliminar el paciente');
                        }
                    }
                });
                }
            });
            
        });

    };
</script>


