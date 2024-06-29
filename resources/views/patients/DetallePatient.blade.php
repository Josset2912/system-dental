@extends('layouts.panel')
@section('styles')
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Tratamiento Paciente</h3>
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

            <input type="text" id="id_del_paciente" class="d-none" value="{{ $idpaciente }}">
            <div class="row ml-2 mr-3">
                <div class="form-group col-2">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="" required>
                </div>
                <div class="form-group col-10">
                    <label for="tratamiento">Tratamiento</label>
                    <input type="text" name="tratamiento" id="tratamiento" class="form-control" value="" required>
                </div>
            </div>

            <div class="row m-2">
                <div class="form-group col-3">
                    <label for="cita">Cita</label>
                    <input type="date" name="cita" id="cita" class="form-control" value="" required>
                </div>
                <div class="form-group col-3">
                    <label for="presupuesto">Presupuesto</label>
                    <input type="number" name="presupuesto" id="presupuesto" class="form-control" value="" onchange="calculateSaldo()" required>
                </div>
                <div class="form-group col-3">
                    <label for="adelanto">Adelanto</label>
                    <input type="number" name="adelanto" id="adelanto" class="form-control" value="" onchange="calculateSaldo()" required>
                </div>
                <div class="form-group col-3">
                    <label for="saldo">Saldo</label>
                    <input type="number" name="saldo" id="saldo" class="form-control" value="" required>
                </div>
            </div>

            <div class="row ml-4">
                <button type="button" id="guardarBtn" onclick="submitForm()" class="btn btn-dark">Guardar</button>
                <button type="button" id="editarBtn" onclick="submitEditForm()" class="btn btn-success d-none">Editar</button>
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
                            <th scope="col">Tratamiento</th>
                            <th scope="col">cita</th>
                            <th scope="col">Presupuesto</th>
                            <th scope="col">Adelanto</th>
                            <th scope="col">Saldo</th>
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
            id_Paciente: document.getElementById('id_del_paciente').value,
            fecha: document.getElementById('fecha').value,
            tratamiento: document.getElementById('tratamiento').value,
            cita: document.getElementById('cita').value,
            presupuesto: document.getElementById('presupuesto').value,
            adelanto: document.getElementById('adelanto').value,
            saldo: document.getElementById('saldo').value
        };

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: "{{ route('saveTratamiento.index') }}", // Replace with your route URL
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response);
                alert('Datos guardados correctamente.');
                $('#myTable').DataTable().ajax.reload();
                document.getElementById('myform').reset(); 
                document.getElementById('saldo').value = 0;
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
        var url = "{{ route('actualizar.tratamiento', ':id') }}".replace(':id', id);

        const formData = {
            _token: "{{ csrf_token() }}",
            id_Paciente: document.getElementById('id_del_paciente').value,
            fecha: document.getElementById('fecha').value,
            tratamiento: document.getElementById('tratamiento').value,
            cita: document.getElementById('cita').value,
            presupuesto: document.getElementById('presupuesto').value,
            adelanto: document.getElementById('adelanto').value,
            saldo: document.getElementById('saldo').value
        };

        // Send AJAX request
        $.ajax({
            type: 'PUT',
            url:url, // Replace with your route URL
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response);
                $('#myTable').DataTable().ajax.reload();
                document.getElementById('myform').reset(); 
                document.getElementById('saldo').value = 0;
                $('#guardarBtn').removeClass('d-none');
                $('#editarBtn').addClass('d-none');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Error al guardar los datos.');
            }
        });
    }


    window.onload = function() {
        var idPaciente = document.getElementById('id_del_paciente').value; // Get the idPaciente value
        var ajaxUrl = "{{ route('PatientTratamientoListar.tratamiento', ':idPaciente') }}".replace(':idPaciente', idPaciente);
        $('#myTable').DataTable({
            ajax: {
            url: ajaxUrl,
            },
          
            columns: [{
                    data: 'fecha'
                },
                {
                    data: 'tratamiento'
                },
                {
                    data: 'cita'
                },
                {
                    data: 'presupuesto'
                },
                {
                    data: 'adelanto'
                },
                {
                    data: 'saldo'
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


        $('#myTable').on('click', '.editarTratamiento', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('listar.tratamiento', ['id' => ':id']) }}".replace(':id',
                id),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#id_del_paciente').val(response.data.id);
                        $('#fecha').val(response.data.fecha);
                        $('#cita').val(response.data.cita);
                        $('#adelanto').val(response.data.adelanto);
                        $('#tratamiento').val(response.data.tratamiento);
                        $('#saldo').val(response.data.saldo);
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


        $('#myTable').on('click', '.eliminarTratamiento', function() {
            var id = $(this).data('id');
            if (confirm('¿Está seguro de que desea eliminar este paciente?')) {
                $.ajax({
                    url: '{{ route("eliminar.tratamiento") }}', // Ruta para eliminar paciente
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








    };


</script>
