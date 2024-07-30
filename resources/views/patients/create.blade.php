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
        border-radius:10px;
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
                        <label for="nombres">Nombre Completo (obligatorio *)</label>
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
                <!-- aqui va el odontograma -->

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

                <div class="d-flex justify-content-left">
                    <button type="submit" id="guardarBtn" class="btn btn-success">Crear paciente</button>
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
                        // Llamar a la función de carga de imágenes pasando el ID del paciente
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
                const noImagesMessage = document.getElementById('no-images');

                // Verificar si el contenedor de imágenes ya existe
                let imageContainer = previewContainer.querySelector('.image-container');

                // Si no hay imágenes previas, ocultar el mensaje correspondiente
                if (noImagesMessage) {
                    noImagesMessage.style.display = 'none';
                }

                // Si no hay un contenedor de imágenes, crear uno nuevo
                if (!imageContainer) {
                    imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');
                    previewContainer.appendChild(imageContainer);
                }

                // Iterar sobre cada archivo seleccionado
                Array.from(files).forEach(file => {
                    if (file) {
                        // Crear elemento de imagen
                        const imgElement = document.createElement('img');
                        imgElement.classList.add('preview-image');

                        // Crear URL temporal para la imagen seleccionada
                        const url = URL.createObjectURL(file);
                        imgElement.src = url;

                        // Crear botón de eliminar
                        const deleteButton = document.createElement('button');
                        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'top-2', 'rounded');
                        deleteButton.innerHTML = '<span class="bg-danger">X</span>';
                        deleteButton.addEventListener('click', function() {
                            imgElement
                                .remove(); // Eliminar la imagen al hacer clic en el botón de eliminar
                            deleteButton.remove(); // Eliminar el botón de eliminar
                            if (!previewContainer.querySelector('.preview-image')) {
                                // Si ya no hay más imágenes, mostrar el mensaje de no imágenes
                                noImagesMessage.style.display = 'block';
                            }
                        });

                        // Agregar la imagen y el botón de eliminar al contenedor de imágenes
                        imageContainer.appendChild(imgElement);
                        imageContainer.appendChild(deleteButton);
                    }
                });
            });

        }
</script>
