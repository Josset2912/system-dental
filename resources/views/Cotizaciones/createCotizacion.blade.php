@extends('layouts.panel')
@section('styles')
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cotizaciones</h3>
                </div>
                <!-- <a href="{{ route('crearPaciente.index') }}" class="btn btn-sm btn-primary">Nuevo Paciente</a> -->
                <div class="col text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>
                        Regresar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
        </div>

        <form id="myform">

            <input type="text" id="id_del_paciente" class="d-none">
            <div class="row ml-2 mr-3">
                <div class="form-group col-2">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="" required>
                </div>
                <div class="form-group col-8">
                    <label for="nombres">Nombre completo</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" value=""
                        placeholder="Nombre completo" required>
                </div>
                <div class="form-group col-2">
                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" id="telefono" class="form-control" placeholder="99999999"
                        value="" required>
                </div>
            </div>

            <div class="row m-2">
                <div class="form-group col-10">
                    <label for="tratamiento">Tratamiento</label>
                    <input type="text" name="tratamiento" id="tratamiento" class="form-control" value=""
                        placeholder="Tratamiento general" onchange="calculateSaldo()" required>
                </div>
                <div class="form-group col-2">
                    <label for="presupuesto">Presupuesto</label>
                    <input type="number" name="presupuesto" id="presupuesto" class="form-control" value=""
                        onchange="calculateSaldo()" placeholder="S/.0000" required>
                </div>
            </div>

            <div class="row ml-4">

                <button type="button" id="guardarBtn" onclick="submitForm()" class="btn btn-dark">Guardar</button>
                <button type="button" id="editarBtn" onclick="submitEditForm()"
                    class="btn btn-success d-none">Editar</button>

                <button type="button" onclick="limpiar()" class="btn btn-gray">Limpiar</button>

            </div>

        </form>

        <hr>

        <div class="row m-3">

            <div class="table-responsive">
                <!--Projects Table -->
                <table class="table align-items-center table-flush" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <!-- <th scope="col">Id Paciente</th> -->
                            <th scope="col">Fecha </th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Tratamiento</th>
                            <th scope="col">Presupuesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


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
                    <p><strong>Nombre:</strong> <span id="fechaMostrar"></span></p>
                    <p><strong>Nombres:</strong> <span id="nombresMostrar"></span></p>
                    <p><strong>Telefono:</strong> <span id="telefonoMostrar"></span></p>
                    <p><strong>Tratamiento:</strong> <span id="tratamientoMostrar"></span></p>
                    <p><strong>Presupuesto:</strong> <span id="presupuestoMostrar"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function calculateSaldo() {
        var presupuesto = parseFloat(document.getElementById('presupuesto').value) || 0;
        var adelanto = parseFloat(document.getElementById('adelanto').value) || 0;
        var saldo = presupuesto - adelanto;
        document.getElementById('saldo').value = saldo;
    }

    function limpiar() {
        document.getElementById('myform').reset();
        $('#guardarBtn').removeClass('d-none');
        $('#editarBtn').addClass('d-none');

    }

    function submitForm() {
        // Get form data
        const formData = {
            _token: "{{ csrf_token() }}",
            nombres: document.getElementById('nombres').value,
            fecha: document.getElementById('fecha').value,
            telefono: document.getElementById('telefono').value,
            tratamiento: document.getElementById('tratamiento').value,
            presupuesto: document.getElementById('presupuesto').value,
        };

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: "{{ route('crear.cotizacion') }}", // Replace with your route URL
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#myTable').DataTable().ajax.reload();
                    document.getElementById('myform').reset();
                    // Opcional: redirigir o actualizar la tabla de cotizaciones
                    window.location.reload(); // Recargar la página
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Error al guardar los datos.');
            }
        });
    }

    function submitEditForm() {
        // Get form data
        var id = $('#id_del_paciente').val();
        var url = "{{ route('actualizar.cotizacion', ':id') }}".replace(':id', id); // Ruta para actualizar

        // Get form data
        const formData = {
            _token: "{{ csrf_token() }}",
            fecha: $('#fecha').val(),
            nombres: $('#nombres').val(),
            telefono: $('#telefono').val(),
            tratamiento: $('#tratamiento').val(),
            presupuesto: $('#presupuesto').val(),
        };

        // Send AJAX request
        $.ajax({
            type: 'PUT',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#myTable').DataTable().ajax.reload();
                    document.getElementById('myform').reset();

                    // Ocultar botón Editar y mostrar botón Guardar
                    $('#editarBtn').addClass('d-none');
                    $('#guardarBtn').removeClass('d-none');

                    window.location.reload(); // Recargar la página
                } else {
                    alert(response.message); // Mostrar mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al actualizar los datos.');
            }
        });

    }

    window.onload = function() {
        var idPaciente = document.getElementById('id_del_paciente').value; // Get the idPaciente value
        // var ajaxUrl = "{{ route('PatientTratamientoListar.tratamiento', ':idPaciente') }}".replace(':idPaciente', idPaciente);
        $('#myTable').DataTable({
            ajax: {
                // url: ajaxUrl,
            },

            columns: [{
                    data: 'fecha'
                },
                {
                    data: 'nombres'
                },
                {
                    data: 'telefono'
                },
                {
                    data: 'tratamiento'
                },
                {
                    data: 'presupuesto'
                },
                {
                    data: 'acciones'
                }
            ],
            language: {
                processing: "Procesando...",
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
            ordering: false,
            searching: false
        });


        $('#myTable').on('click', '.editarCotizacion', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('listar.cotizacion', ['id' => ':id']) }}".replace(':id',
                    id),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#id_del_paciente').val(response.data.id);
                        $('#fecha').val(response.data.fecha);
                        $('#nombres').val(response.data.nombres);
                        $('#telefono').val(response.data.telefono);
                        $('#tratamiento').val(response.data.tratamiento);
                        $('#presupuesto').val(response.data.presupuesto);

                        $('#guardarBtn').addClass('d-none');
                        $('#editarBtn').removeClass('d-none');

                    } else {
                        alert(response.message); // Mostrar mensaje de error
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error al obtener los datos de la cotización.');
                }
            });
        });


        $('#myTable').on('click', '.eliminarCotizacion', function() {
            var id = $(this).data('id');
            if (confirm('¿Está seguro de que desea eliminar este paciente?')) {
                $.ajax({
                    url: '{{ route('eliminar.cotizacion') }}', // Ruta para eliminar paciente
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#myTable').DataTable().ajax.reload();
                        } else {
                            alert('Hubo un error al eliminar el paciente');
                        }
                    }
                });
            }
        });

        $(document).on('click', '.levantarModal', function() {
            var data = $('#myTable').DataTable().row($(this).parents('tr')).data();
            console.log(data);
            $('#fechaMostrar').text(data.fecha);
            $('#nombresMostrar').text(data.nombres);
            $('#telefonoMostrar').text(data.telefono);
            $('#tratamientoMostrar').text(data.tratamiento);
            $('#presupuestoMostrar').text(data.presupuesto);
            $('#exampleModal').modal('show');
        });

    };
</script>
