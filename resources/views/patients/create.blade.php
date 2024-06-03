@extends('layouts.panel')

<style>
        .form-check-input-lg {
            width: 1em;
            height: 1em;
        }
    </style>

    
@section('content')


    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"> Crear Paciente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>
                        Regresar</a>
                </div>
            </div>
        </div>
        <!--Projects Table -->
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!!!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif

            <form id="editForm" name="editForm" method="POST">
                <div class="row">
                    <div class="form-group col-8">
                        <label for="nombres">Nombre Completo</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="" required>
                    </div>
                    <!-- <div class="form-group col-4">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" value="" required>
                    </div> -->
                    <div class="form-group col-4">
                        <label for="apellidos">Fecha</label>
                        <input type="date" name="apellidos" id="apellidos" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3">
                        <label for="my-select">Estado civil</label>
                        <select id="my-select" class="form-control" name="">
                            <option>Selecciona</option>
                            <option>Casado</option>
                            <option>No opina</option>

                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="telefono">Profesión</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="especialidad">Dirección</label>
                        <input type="text" name="especialidad" id="especialidad" class="form-control" value=""
                            required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="alergias">Motivo de consulta</label>
                        <textarea name="alergias" id="alergias" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row m-2">
                    <p>
                        <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                           Ver Odontograma
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="row justify-content-center mt-2 mb-2">
                            <img src="{{asset('img/brand/odontograma.png')}}" class="w-75" />
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-around align-items-center ">
                            <steong>Alergico</steong>   
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            No
                        </label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            Antibiotico
                        </label>
                    </div>
                    <div class="form-group col-5">
                        <label for="especialidad">Anestesico</label>
                        <input type="text" name="especialidad" id="especialidad" class="form-control form-control-sm" value=""
                            required>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-center align-items-center ">
                            <steong>Tomando medicamento</steong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            No
                        </label>
                    </div>

                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            Si
                        </label>
                    </div>
                    <div class="form-group col-5">
                        <label for="especialidad"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-around align-items-center ">
                            <steong>Problema de salud</steong>   
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            No
                        </label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg " type="checkbox" >
                        <label class="" for="">
                            Si
                        </label>
                    </div>
                    <div class="form-group col-5">
                        <label for="especialidad">Especificar</label>
                        <input type="text" name="especialidad" id="especialidad" class="form-control form-control-sm" value=""
                            required>
                    </div>
                </div>

                <div class="row flex-column m-2">
                        <div class="mb-3">
                            <a class="btn btn-success" data-toggle="collapse" href="#planotratamiento" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                               Plano de tratamiento 
                            </a>
                        </div>
                        <div class="collapse"  id="planotratamiento">
                            <div class="row border rounded">
                                <div class="form-group col-6">
                                    <label for="apellidos">Fecha de inicio</label>
                                    <input type="date" name="apellidos" id="apellidos" class="form-control" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="apellidos">Fecha de fin</label>
                                    <input type="date" name="apellidos" id="apellidos" class="form-control" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="alergias">Detalles</label>
                                    <textarea name="alergias" id="alergias" class="form-control" required></textarea>
                                </div>

                            </div>
                        </div>

                </div>
                
                


                <button type="submit" id="guardarBtn" class="btn btn-primary"">Crear</button>
            </form>



        </div>
    </div>
    </div>
@endsection



<script>
    window.onload = function() {
        $('#guardarBtn').click(function(event) {
            // Evitar el comportamiento predeterminado del botón de enviar formulario
            event.preventDefault();

            // Capturar el ID del paciente desde el atributo data
            var pacienteId = $('#pacienteId').val();

            // Obtener los valores de cada campo
            var nombres = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var telefono = $('#telefono').val();
            var especialidad = $('#especialidad').val();
            var alergias = $('#alergias').val();
            var observaciones = $('#observaciones').val();

            // Crear un objeto con los datos del formulario
            var formData = {
                _token: "{{ csrf_token() }}",
                _method: "POST",
                nombres: nombres,
                apellidos: apellidos,
                correo: correo,
                telefono: telefono,
                especialidad: especialidad,
                alergias: alergias,
                observaciones: observaciones
            };

            // Realizar la petición AJAX
            $.ajax({
                type: 'post',
                url: "{{ route('createPatient.crear') }}",
                data: formData,
                success: function(data) {
                    // Manejar la respuesta del servidor
                    window.location.href = "{{ url('/pacientes') }}";

                },
                error: function(xhr, status, error) {
                    // Manejar los errores
                    console.error(error);
                }
            });
        });
    }
</script>
