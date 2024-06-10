@extends('layouts.panel')

<style>
    .form-check-input-lg {
        width: 1em;
        height: 1em;
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
    }

    .preview-image {
        width: 200px;
        height: 200px;
        border: 1px solid #ddd;
        margin: 10px;
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
                    <div class="form-group col-4">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3">
                        <label for="estado_civil">Estado civil</label>
                        <select id="estado_civil" class="form-control" name="estado_civil">
                            <option>Selecciona</option>
                            <option value="1">Soltero</option>
                            <option value="2">Casado</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="profesion">Profesión</label>
                        <input type="text" name="profesion" id="profesion" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-9">
                        <label for="motivo">Motivo de consulta</label>
                        <input type="text" name="motivo" id="motivo" class="form-control" value="" required>
                    </div>
                </div>

                <hr>

                <div class="row m-2">
                    <div class="flex-column">
                        <div>
                            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample2" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                Imagenes del paciente
                            </a>
                        </div>
                        <div>
                            <div class="collapse" id="collapseExample2">
                                <div class="row mt-2 ml-2 mb-2">
                                    <input type="file" name="images[]" id="images" accept="image/*" multiple>
                                </div>
                                <div>
                                    <div class="preview-container" id="preview-container"></div>
                                    <button type="button" class="btn btn-dark" id="uploadBtn">Subir </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row m-2">
                    <p>
                        <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Ver Odontograma
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="row justify-content-center mt-2 mb-2">
                            <img src="{{ asset('img/brand/odontograma.png') }}" class="w-75" />
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
                        <strong>Alergico</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="alergico[]" value="1">
                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="alergico[]" value="2">
                        <label>Antibiotico</label>
                    </div>
                    <div class="form-group col-5">
                        <label for="alergico_detalle">Anestesico</label>
                        <input type="text" name="alergico_detalle" id="alergico_detalle"
                            class="form-control form-control-sm" value="" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-center align-items-center ">
                        <strong>Tomando medicamento</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="medicamento[]" value="1">
                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="medicamento[]" value="2">
                        <label>Si</label>
                    </div>
                    <div class="form-group col-5">
                        <label for=""></label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-around align-items-center ">
                        <strong>Problema de salud</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="problema_salud[]" value="1">
                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around ">
                        <input class="form-check-input-lg" type="checkbox" name="problema_salud[]" value="2">
                        <label>Si</label>
                    </div>
                    <div class="form-group col-5">
                        <label for="problema_detalle">Especificar</label>
                        <input type="text" name="problema_detalle" id="problema_detalle"
                            class="form-control form-control-sm" value="" required>
                    </div>
                </div>

                <hr>

                <div class="row flex-column m-2">
                    <div class="mb-3">
                        <a class="btn btn-success" data-toggle="collapse" href="#planotratamiento" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Plano de tratamiento
                        </a>
                    </div>
                    <div class="collapse" id="planotratamiento">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-6">
                                <label for="fecha_fin">Fecha de fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="detalles_tratamiento">Detalles</label>
                                <textarea name="detalles_tratamiento" id="detalles_tratamiento" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" id="guardarBtn" class="btn btn-primary">Crear paciente</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        $('#guardarBtn').click(function(event) {
            event.preventDefault();
            var formData = {
                _token: "{{ csrf_token() }}",
                nombres: $('#nombres').val(),
                fecha: $('#fecha').val(),
                estado_civil: $('#estado_civil').val(),
                profesion: $('#profesion').val(),
                direccion: $('#direccion').val(),
                telefono: $('#telefono').val(),
                motivo: $('#motivo').val(),
                observaciones: $('#observaciones').val(),
                alergico: $("input[name='alergico[]']:checked").map(function() {
                    return this.value;
                }).get(),
                alergico_detalle: $('#alergico_detalle').val(),
                medicamento: $("input[name='medicamento[]']:checked").map(function() {
                    return this.value;
                }).get(),
                problema: $("input[name='problema_salud[]']:checked").map(function() {
                    return this.value;
                }).get(),
                problema_detalle: $('#problema_detalle').val(),
                fecha_inicio: $('#fecha_inicio').val(),
                fecha_fin: $('#fecha_fin').val(),
                detalles_tratamiento: $('#detalles_tratamiento').val()
            };
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
            console.log(formData);
        });

        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Clear previous previews

            Array.from(files).forEach(file => {
                if (file) {
                    const imgElement = document.createElement('img');
                    imgElement.classList.add('preview-image');
                    imgElement.src = URL.createObjectURL(file);
                    previewContainer.appendChild(imgElement);
                }
            });
        });


        $(document).ready(function() {
            $('#uploadBtn').click(uploadImages);
        });

        function uploadImages() {
            const files = document.getElementById('images').files;
            const formData = new FormData();

            if (files.length === 0) {
                alert('Por favor, selecciona al menos una imagen antes de subir.');
                return;
            } else {
                for (const file of files) {
                    formData.append('images[]', file);
                }
                formData.append('paciente_id', '34'); 
                $.ajax({
                    url: '{{ route('upload') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            alert('Imágenes subidas con éxito');
                        } else {
                            alert('Error al subir imágenes');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        }
    }
</script>
