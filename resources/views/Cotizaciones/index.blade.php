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
                    <button class="btn btn-sm btn-success" onclick="abrirModal(event)">
                        <i class="fas fa-add"></i>
                        Nueva cotización</button>
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

        <div class="modal fade bd-example-modal-xl" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar cotización</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <input type="text" id="id_del_paciente" class="d-none">
                            <div class="row ml-2 mr-3">
                                <div class="form-group col-12">
                                    <label for="nombres">Nombre completo</label>
                                    <input type="text" name="nombres" id="nombres" class="form-control form-control-sm"
                                        value="" placeholder="Nombre completo" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control form-control-sm"
                                        value="" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="nombres">Telefono</label>
                                    <input type="number" name="telefonoEdit" id="telefonoEdit"
                                        class="form-control form-control-sm" value="" placeholder="Nombre completo"
                                        required>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-12">
                                    <button type="button" id="editTratamientoBtn" class="btn btn-primary btn-sm ">+
                                        tratamiento</button>
                                </div>
                            </div>

                            <div id="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 80%;">Tratamiento</th>
                                            <th style="width: 20%;">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detallesCotizacion">
                                        <!-- Rows will be added dynamically here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td>S/.<strong id="totalPrecioEdit">0</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <hr>
                            </div>
                            <div class="row ml-4">
                                <button type="button" id="guardarBtn" onclick="submitForm()"
                                    class="btn btn-dark">Guardar</button>
                                <button type="button" id="editarBtn" onclick="submitEditForm()"
                                    class="btn btn-success d-none">Actualizar</button>

                                <button type="button" onclick="limpiar()" class="btn btn-gray"
                                    data-dismiss="modal">Cerrar</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div class="modal fade bd-example-modal-xl" id="nuevoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva cotización</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myform">
                            <input type="text" id="id_del_paciente" class="d-none">
                            <div class="row ml-2 mr-3">
                                <div class="form-group col-12">
                                    <label for="nombres">Nombre completo</label>
                                    <input type="text" name="nombresAdd" id="nombresAdd"
                                        class="form-control form-control-sm" value="" placeholder="Nombre completo"
                                        required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="fecha">Fecha cotización</label>
                                    <input type="date" name="fechaAdd" id="fechaAdd"
                                        class="form-control form-control-sm" value="" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="nombres">Telefono</label>
                                    <input type="text" name="telefono" id="telefono"
                                        class="form-control form-control-sm" value="" placeholder="Telefono "
                                        required>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-12">
                                    <button type="button" id="addTratamientoBtnAdd" class="btn btn-primary btn-sm ">+
                                        tratamiento</button>
                                </div>
                            </div>

                            <div id="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70%;">Tratamiento</th>
                                            <th style="width: 15%;">Precio</th>
                                            <th style="width: 15%;">Acción</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tratamientosTableBodyAdd">
                                        <!-- Rows will be added dynamically here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td>S/.<strong id="totalPrecioAdd">0</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <div class="row ml-4">

                                <button type="button" id="guardarBtn" onclick="submitForm()"
                                    class="btn btn-dark">Guardar</button>
                                <button type="button" class="btn btn-gray" data-dismiss="modal">Cerrar</button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        <hr>

        <div class="row m-3">
            <div class="table-responsive">
                <!--Projects Table -->
                <table class="table align-items-center table-flush" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <!-- <th scope="col">Id Paciente</th> -->
                            <th scope="col">Fecha creación </th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Tratamiento</th>
                            <th scope="col">Actualizado el</th>
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


    <div class="modal fade bd-example-modal-xl  " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Fecha de creación: <strong><span id="fechaMostrar"></span></strong>
                    </p>
                    <p>
                        Nombre completo: <strong><span id="nombresMostrar"></span></strong>
                    </p>
                    <p>
                        Telefono/Celular: <strong><span id="telefonoMostrar"></span></strong>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>

    window.onload = function() {
        var idPaciente = document.getElementById('id_del_paciente').value; // Get the idPaciente value
        // var ajaxUrl = "{{ route('PatientTratamientoListar.tratamiento', ':idPaciente') }}".replace(':idPaciente', idPaciente);
        $('#myTable').DataTable({
            ajax: {
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
                    data: 'fechaupdate',
                    render: function(data, type, row) {
                        return moment(data).format('DD/MM/YYYY HH:mm');
                    }
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

        function updateTotal() {
            let total = 0;
            $("input[name='presupuesto[]']").each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#totalPrecioAdd').text(total.toFixed(2));
        }

        function updateTotalEdit() {
            let total = 0;
            $("input[name='presupuestoEdit[]']").each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#totalPrecioEdit').text(total.toFixed(2));
        }

        $('#addTratamientoBtnAdd').click(function() {
            var newRow = `
                <tr>
                    <td style="width: 80%;"><input type="text" name="tratamiento[]" class="form-control tratamiento form-control-sm" placeholder="Tratamiento adicional" required></td>
                    <td style="width: 20%;"><input type="number" name="presupuesto[]" class="form-control presupuesto form-control-sm" placeholder="S/.0000" required></td>
                    <td style="width: 20%;"><button type="button" class="btn btn-danger btn-sm delete-row">Eliminar</button></td>
                </tr>
            `;
            // Añadir la nueva fila al cuerpo de la tabla
            $('#tratamientosTableBodyAdd').append(newRow);
        });

        $('#editTratamientoBtn').click(function() {
            var newRow = `
                <tr>
                    <td style="width: 80%;"><input type="text" name="tratamientoEdit[]" class="form-control tratamiento form-control-sm" placeholder="Tratamiento adicional" required></td>
                    <td style="width: 20%;"><input type="number" name="presupuestoEdit[]" class="form-control presupuesto form-control-sm" placeholder="S/.0000" required></td>
                    <td style="width: 20%;"><button type="button" class="btn btn-danger btn-sm delete-row">Eliminar</button></td>
                </tr>
            `;
            // Añadir la nueva fila al cuerpo de la tabla
            $('#detallesCotizacion').append(newRow);
        });

        $('#detallesCotizacion').on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
            updateTotalEdit();
        });

        $('#tratamientosTableBodyAdd').on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
            updateTotal();
        });

        $('#myTable').on('click', '.editarCotizacion', function() {
            $('#editModal').modal('show');
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('listar.cotizacion', ['id' => ':id']) }}".replace(':id',
                    id),
                type: 'GET',
                success: function(response) {
                    if (response.success) {

                        var cotizacion = response.cotizacion;
                        var detalles = response.detalles;
                        $('#id_del_paciente').val(cotizacion.id);
                        $('#fecha').val(cotizacion.fecha);
                        $('#nombres').val(cotizacion.nombres);
                        $('#telefonoEdit').val(cotizacion.telefono);
                        var detallesHtml = '';
                        var totalPresupuesto = 0;
                        detalles.forEach(function(detalle) {
                            detallesHtml += `
                               <tr>
                                 <td style="width: 80%;"><input type="text" name="tratamientoEdit[]" class="form-control tratamiento form-control-sm" placeholder="Tratamiento adicional" required value="${detalle.tratamiento}"></td>
                                <td style="width: 20%;"><input type="number" name="presupuestoEdit[]" class="form-control presupuesto form-control-sm" placeholder="S/.0000" required value="${detalle.presupuesto}"></td>
                                <td style="width: 20%;"><button type="button" class="btn btn-danger btn-sm delete-row">Eliminar</button></td>
                               </tr>
                            `;
                            totalPresupuesto += parseFloat(detalle.presupuesto) || 0;
                        });
                        $('#totalPrecioEdit').val(totalPresupuesto.toFixed(2));


                        $('#detallesCotizacion').html(detallesHtml);
                        updateTotalEdit();


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
            })
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

        $('#tratamientosTableBodyAdd').on('input', "input[name='presupuesto[]']", updateTotal);

        $('#detallesCotizacion').on('input', "input[name='presupuestoEdit[]']", updateTotalEdit);

    }
    
    function abrirModal(e) {
        e.preventDefault(); // Utiliza e en lugar de event
        $('#nuevoModal').modal('show');
    }

    function submitForm() {
        // Get form data

        var id = $('#id_del_paciente').val();
        var tratamientos = [];

        // Recorrer los inputs de tratamiento y presupuesto para construir el array de pares
        $("input[name='tratamiento[]']").each(function(index) {
            var tratamiento = $(this).val();
            var presupuesto = $("input[name='presupuesto[]']").eq(index).val();
            tratamientos.push({
                tratamiento: tratamiento,
                presupuesto: presupuesto
            });
        });


        const formData = {
            _token: "{{ csrf_token() }}",
            nombres: document.getElementById('nombresAdd').value,
            fecha: document.getElementById('fechaAdd').value,
            telefono: document.getElementById('telefono').value,
            tratamientos: tratamientos
        };

        console.log(formData);

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

        var tratamientos = [];
        // Recorrer los inputs de tratamiento y presupuesto para construir el array de pares
        $("input[name='tratamientoEdit[]']").each(function(index) {
            var tratamiento = $(this).val();
            var presupuesto = $("input[name='presupuestoEdit[]']").eq(index).val();
            tratamientos.push({
                tratamiento: tratamiento,
                presupuesto: presupuesto
            });
        });
        var url = "{{ route('actualizar.cotizacion', ':id') }}".replace(':id', id); // Ruta para actualizar
        // Get form data
        const formData = {
            _token: "{{ csrf_token() }}",
            fecha: $('#fecha').val(),
            nombres: $('#nombres').val(),
            telefono: $('#telefonoEdit').val(),
            tratamiento: tratamientos
        };

        console.log(formData);

        // Send AJAX request
        $.ajax({
            type: 'PUT',
            url: url,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#myTable').DataTable().ajax.reload();
                    document.getElementById('myform').reset();
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

   

</script>
