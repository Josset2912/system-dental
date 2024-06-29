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
        border-radius: 20px
    }
    .diente {
    position: static;
    width: 0px;
    height: auto;
    margin-left: 50px;
    display: inline-block;
    }

    .cuadro {
        background-color: #FFFFFF;
        border: 1px solid #7F7F7F;
        position: relative;
        width: 25px;
        height: 15px;
        left: 45px;
        -webkit-border-radius: 80px 80px 0px 15px;
        -moz-border-radius: 80px 80px 0px 15px;
        border-radius: 80px 80px 0px 15px;
    }

    .cuadro:hover {
        /*background: rgba(117, 198, 243, 0.4);*/
        
        cursor: pointer;
    }

    .izquierdo {
        top: 1px !important;
        left: 28px !important;
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .debajo {
        top: 2px !important;
        left: 45px !important;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .derecha {
        top: -29px !important;
        left: 61px !important;
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .centro {
        background: #F3F3F3;
        border: 1px solid #7F7F7F;
        width: 25px;
        height: 25px;
        top: -49px;
        left: 45px;
        position: relative;
    }

    .centro:hover {
        border: 1px solid rgba(117, 198, 243, 0.4);
        /*background-color: rgba(117, 198, 243, 0.4);*/
        
        cursor: pointer;
    }

    #tlr {
        border-bottom: 1px solid black;
        border-right: 1px solid black;
    }
    #tr {
        border-right: 1px solid black;
    }
    #tll {
        border-bottom: 1px solid black;
        border-left: 1px solid black;
    }
    #tl {
        border-left: 1px solid black;
    }

    #blr {
        border-right: 1px solid black;
    }
    #br {
        border-right: 1px solid black;
    }
    #bl {
        border-left: 1px solid black;
    }
    #bll {
        border-left: 1px solid black;
    }
    .click-red {
        background-color: red !important;
    }

    .click-blue {
        background-color: blue;
    }

    .click-delete {
        background-color: #747F7D !important;
    }

    .kill {
        background-color: green;
    }

    .diente-leche {
        position: relative;
        width: 0px;
        height: auto;
        margin-left: 50px;
        display: inline-block;
    }

    .cuadro-leche {
        border: 1px solid #7F7F7F;
        position: relative;
        width: 13px;
        height: 13px;
        left: 45px;
        -webkit-border-radius: 80px 80px 0px 15px;
        -moz-border-radius: 80px 80px 0px 15px;
        border-radius: 80px 80px 0px 15px;
    }

    .cuadro-leche:hover {
        /*background: rgba(117, 198, 243, 0.4);*/
        
        cursor: pointer;
    }

    .izquierdo-leche {
        top: -4px !important;
        left: 37px !important;
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .top-leche {
        width: 15px;
        left: 47px;
    }

    .debajo-leche {
        width: 15px;
        top: -8px !important;
        left: 47px !important;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .derecha-leche {
        top: -30px !important;
        left: 58px !important;
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .centro-leche {
        background: #F3F3F3;
        border: 1px solid #7F7F7F;
        width: 15px;
        height: 13px;
        top: -43px;
        left: 47px;
        position: relative;
    }

    .centro-leche:hover {
        border: 1px solid rgba(117, 198, 243, 0.4);
        /*background-color: rgba(117, 198, 243, 0.4);*/
        
        cursor: pointer;
    }

</style>

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"> Editar Paciente</h3>
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

            <input type="text" class="d-none" value="{{ $paciente->id_paciente }}" id="pacienteId">

            <div class="row justify-content-start">
                <a class="btn btn-info btn-sm m-3"
                    href="{{ route('PacienteDetalle.tratamiento', $paciente->id_paciente) }}">
                    <i class="fas fa-eye"></i> Tratamiento
                </a>
            </div>

            <form id="editForm" name="editForm" method="POST">
                <div class="row">
                    <div class="form-group col-8">
                        <label for="nombres">Nombre completo</label>
                        <input type="text" name="nombres" id="nombres" class="form-control"
                            value="{{ $paciente->nombres }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control"
                            value="{{ $paciente->fecha }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="estado_civil">Estado civil</label>
                        <select id="estado_civil" class="form-control" name="estado_civil">
                            <option value="1" {{ $paciente->estado_civil == 1 ? 'selected' : '' }}>Soltero</option>
                            <option value="2" {{ $paciente->estado_civil == 2 ? 'selected' : '' }}>Casado</option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="profesion">Profesión</label>
                        <input type="text" name="profesion" id="profesion" class="form-control"
                            value="{{ $paciente->profesion }}" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control"
                            value="{{ $paciente->direccion }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control"
                            value="{{ $paciente->telefono }}" required>
                    </div>
                    <div class="form-group col-8">
                        <label for="motivo">Motivo de consulta</label>
                        <input type="text" name="motivo_consulta" id="motivo_consulta" class="form-control"
                            value="{{ $paciente->motivo_consulta }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control" value="" required> {{ $paciente->observaciones }} </textarea>
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

                        <div class="collapse" id="collapseExample2">
                            <div class="row mt-2 ml-2 mb-2">
                                <input type="file" name="images[]" id="images" accept="image/*" multiple>
                            </div>
                            <div>
                                @if (!empty($rutas_imagenes))
                                    <div class="preview-container row" id="preview-container">
                                        @foreach ($rutas_imagenes as $ruta_imagen)
                                            <div class="">
                                                <img src="{{ $ruta_imagen }}" alt="Imagen del paciente"
                                                    class="preview-image">
                                                <button class="btn btn-danger btn-sm top-2 rounded"
                                                    onclick="deleteImage('{{ $ruta_imagen }}')">
                                                    <span class="bg-danger">X</span>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="preview-container row" id="preview-container">

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-column m-2">
                    <p>
                        <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Ver Odontograma
                        </a>
                    </p>

                    <div class="collapse" id="collapseExample">
                            
                        <div class="row">
                            <div class="container">
                                <div class="panel panel-primary">
                                    
                                    <div class="panel-heading">
                                        <h3 class="panel-title"></h3>
                                    </div>

                                    <div class="d-flex flex-column ">
                                        
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div id="controls" class="panel panel-default">
                                                    <div class="d-flex justify-content-center mb-3 ">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label id="fractura" class="btn btn-danger active d-none">
                                                                <input type="radio" name="options" id="option1" autocomplete="off" checked>Fractura
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="tr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                            <div id="tl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                            <div id="tlr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                            </div>
                                            <div id="tll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <div id="blr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                            </div>
                                            <div id="bll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                            <div id="br" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                            <div id="bl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            </div>
                                        </div>

                                        <div class="row">
                                         
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <div class="row">

                    <div class="form-group col-3 d-flex justify-content-around align-items-center">
                        <strong>Alergico</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="alergico[]" value="1"
                            {{ $paciente->alergico == 1 ? 'checked' : '' }}>
                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="alergico[]" value="2"
                            {{ $paciente->alergico == 2 ? 'checked' : '' }}>
                        <label>Antibiotico</label>
                    </div>
                    <div class="form-group col-5">
                        <label for="alergico_detalle">Anestesico</label>
                        <input type="text" name="alergico_detalle" id="alergico_detalle"
                            class="form-control form-control-sm" value="{{ $paciente->alergico_detalle }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-center align-items-center">
                        <strong>Tomando medicamento</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="medicamento[]" value="1"
                            {{ $paciente->medicamento == 1 ? 'checked' : '' }}>

                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="medicamento[]" value="2"
                            {{ $paciente->medicamento == 2 ? 'checked' : '' }}>

                        <label>Si</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-3 d-flex justify-content-around align-items-center">
                        <strong>Problema de salud</strong>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="problema[]" value="1"
                            {{ $paciente->problema == 1 ? 'checked' : '' }}>
                        <label>No</label>
                    </div>
                    <div class="form-group col-2 d-flex align-items-center justify-content-around">
                        <input class="form-check-input-lg" type="checkbox" name="problema[]" value="2"
                            {{ $paciente->problema == 2 ? 'checked' : '' }}>

                        <label>Si</label>
                    </div>
                    <div class="form-group col-5">
                        <label for="problema_detalle">Especificar</label>
                        <input type="text" name="problema_detalle" id="problema_detalle"
                            class="form-control form-control-sm" value="{{ $paciente->problema_detalle }}">
                    </div>
                </div>

                <hr>

                
                <button type="submit" id="guardarBtn" class="btn btn-primary"
                    data-id="{{ $paciente->id }}">Editar</button>
            </form>
        </div>
    </div>
@endsection

<script>
    
    function deleteImage(imagePath) {
        if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
            $.ajax({
                url: '{{ route('deleteImage.index') }}', // Your route to handle image deletion
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Laravel CSRF token for security
                    path: imagePath
                },
                success: function(response) {
                    if (response.success) {
                        alert('Imagen eliminada con éxito');
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        alert('Error al eliminar la imagen' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    alert('Error al eliminar la imagen');
                }
            });
        }
    }

    function replaceAll(find, replace, str) {
        return str.replace(new RegExp(find, 'g'), replace);
    }

    // Función para crear el odontograma
    function createOdontogram(datosBd,selecciones) {

        var htmlLecheLeft = "",
            htmlLecheRight = "",
            htmlLeft = "",
            htmlRight = "",
            a = 1;

        for (var i = 9 - 1; i >= 1; i--) {
            // Dientes Definitivos Cuadrante Derecho (Superior/Inferior)
            var index = i.toString();
            htmlRight += '<div data-name="value" id="dienteindex' + index + '" class="diente">' +
                '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-info">index' + index + '</span>' +
                '<div id="tindex' + index + '" class="cuadro click" data-id="t' + index + '">' +
                '</div>' +
                '<div id="lindex' + index + '" class="cuadro izquierdo click" data-id="l' + index + '">' +
                '</div>' +
                '<div id="bindex' + index + '" class="cuadro debajo click" data-id="b' + index + '">' +
                '</div>' +
                '<div id="rindex' + index + '" class="cuadro derecha click click" data-id="r' + index + '">' +
                '</div>' +
                '<div id="cindex' + index + '" class="centro click" data-id="c' + index + '">' +
                '</div>' +
                '</div>';

            // Dientes Definitivos Cuadrante Izquierdo (Superior/Inferior)
            htmlLeft += '<div id="dienteindex' + a + '" class="diente">' +
                '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-info">index' + a + '</span>' +
                '<div id="tindex' + a + '" class="cuadro click" data-id="t' + a + '">' +
                '</div>' +
                '<div id="lindex' + a + '" class="cuadro izquierdo click" data-id="l' + a + '">' +
                '</div>' +
                '<div id="bindex' + a + '" class="cuadro debajo click" data-id="b' + a + '">' +
                '</div>' +
                '<div id="rindex' + a + '" class="cuadro derecha click click" data-id="r' + a + '">' +
                '</div>' +
                '<div id="cindex' + a + '" class="centro click" data-id="c' + a + '">' +
                '</div>' +
                '</div>';

            if (i <= 5) {
                // Dientes Temporales Cuadrante Derecho (Superior/Inferior)
                htmlLecheRight += '<div id="dienteLindex' + i + '" style="left: -25%;" class="diente-leche">' +
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-primary">index' + i + '</span>' +
                    '<div id="tlecheindex' + i + '" class="cuadro-leche top-leche click" data-id="tleche' + i + '">' +
                    '</div>' +
                    '<div id="llecheindex' + i + '" class="cuadro-leche izquierdo-leche click" data-id="lleche' + i + '">' +
                    '</div>' +
                    '<div id="blecheindex' + i + '" class="cuadro-leche debajo-leche click" data-id="bleche' + i + '">' +
                    '</div>' +
                    '<div id="rlecheindex' + i + '" class="cuadro-leche derecha-leche click click" data-id="rleche' + i + '">' +
                    '</div>' +
                    '<div id="clecheindex' + i + '" class="centro-leche click" data-id="cleche' + i + '">' +
                    '</div>' +
                    '</div>';
            }

            if (a < 6) {
                // Dientes Temporales Cuadrante Izquierdo (Superior/Inferior)
                htmlLecheLeft += '<div id="dienteLindex' + a + '" class="diente-leche">' +
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-primary">index' + a + '</span>' +
                    '<div id="tlecheindex' + a + '" class="cuadro-leche top-leche click" data-id="tleche' + a + '">' +
                    '</div>' +
                    '<div id="llecheindex' + a + '" class="cuadro-leche izquierdo-leche click" data-id="lleche' + a + '">' +
                    '</div>' +
                    '<div id="blecheindex' + a + '" class="cuadro-leche debajo-leche click" data-id="bleche' + a + '">' +
                    '</div>' +
                    '<div id="rlecheindex' + a + '" class="cuadro-leche derecha-leche click click" data-id="rleche' + a + '">' +
                    '</div>' +
                    '<div id="clecheindex' + a + '" class="centro-leche click" data-id="cleche' + a + '">' +
                    '</div>' +
                    '</div>';
            }

            a++;
        }

        $("#tr").append(replaceAll('index', '1', htmlRight));
        $("#tl").append(replaceAll('index', '2', htmlLeft));
        $("#tlr").append(replaceAll('index', '5', htmlLecheRight));
        $("#tll").append(replaceAll('index', '6', htmlLecheLeft));

        $("#bl").append(replaceAll('index', '3', htmlLeft));
        $("#br").append(replaceAll('index', '4', htmlRight));
        $("#bll").append(replaceAll('index', '7', htmlLecheLeft));
        $("#blr").append(replaceAll('index', '8', htmlLecheRight));

        // Iterar sobre los datos de la base de datos y marcar los cuadros correspondientes
        for (var key in datosBd) {
            if (datosBd[key] == 1) {
                var id = key.replace('_', '');
                // $('#' + id).addClass('click-red');
                $('#' + id).addClass('click-red').addClass('selected'); 
                
            }
        }

        for (var key in datosBd) {
            var id = key.replace('_', '');
            if (datosBd[key] == 1 && selecciones.indexOf(id) === -1) {
                selecciones.push(id);
            }
        }

        selecciones = selecciones.filter(function(item, index, self) {
        return self.indexOf(item) === index;
    });
    }

    var selecciones = [];
    
    var datosBd = {!! json_encode($datosOdontograma) !!};
    
    window.onload = function() {

        createOdontogram(datosBd,selecciones);
        
        $(".click").click(function(event) {
            var id = $(this).attr('id');
            var control = $("#controls").children().find('.active').attr('id');
            var cuadro = $(this).find("input[name=cuadro]:hidden").val();
            console.log(id);
            // Añadir o eliminar del array de selecciones
                // Añadir o eliminar del array de selecciones
            if ($(this).hasClass("selected")) {
                // Si ya está seleccionado, eliminar
                $(this).removeClass('selected');
                var index = selecciones.indexOf(id);
                if (index !== -1) {
                    selecciones.splice(index, 1); // Elimina solo la primera instancia encontrada
                }
            } else {
                // Si no está seleccionado, añadir
                $(this).addClass('selected');
                selecciones.push(id);
            }

            // Mostrar el array en la consola
            console.log("soy selecciones");
            console.log(selecciones);

            switch (control) {
                case "fractura":
                    if ($(this).hasClass("click-blue")) {
                        $(this).removeClass('click-blue');
                        $(this).addClass('click-red');
                    } else {
                        if ($(this).hasClass("click-red")) {
                            $(this).removeClass('click-red');
                        } else {
                            $(this).addClass('click-red');
                        }
                    }
                    break;
                case "restauracion":
                    if ($(this).hasClass("click-red")) {
                        $(this).removeClass('click-red');
                        $(this).addClass('click-blue');
                    } else {
                        if ($(this).hasClass("click-blue")) {
                            $(this).removeClass('click-blue');
                        } else {
                            $(this).addClass('click-blue');
                        }
                    }
                    break;
               
            }

            return false;
        });

        $('#guardarBtn').click(function(event) {
            event.preventDefault();
            var pacienteId = $('#pacienteId').val();
            var nombres = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var fecha = $('#fecha').val();
            var correo = $('#correo').val();
            var motivo = $('#motivo_consulta').val();
            var telefono = $('#telefono').val();
            var especialidad = $('#especialidad').val();
            var direccion = $('#direccion').val();
            var profesion = $('#profesion').val();
            var estado_civil = $('#estado_civil').val();
            var alergias = $('#alergias').val();
            var observaciones = $('#observaciones').val();
            var alergico = $('input[name="alergico[]"]:checked').map(function() {
                return this.value;
            }).get();
            var alergico_detalle = $('#alergico_detalle').val();
            var medicamento = $('input[name="medicamento[]"]:checked').map(function() {
                return this.value;
            }).get();
            var problema_salud = $('input[name="problema[]"]:checked').map(function() {
                return this.value;
            }).get();
            var problema_detalle = $('#problema_detalle').val();
            

            // Crear un objeto formData con los datos del formulario
            var formData = {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                pacienteId: pacienteId,
                nombres: nombres,
                apellidos: apellidos,
                fecha: fecha,
                correo: correo,
                telefono: telefono,
                especialidad: especialidad,
                direccion: direccion,
                profesion: profesion,
                motivo: motivo,
                estado_civil: estado_civil,
                alergias: alergias,
                observaciones: observaciones,
                alergico: alergico,
                alergico_detalle: alergico_detalle,
                medicamento: medicamento,
                problema_salud: problema_salud,
                problema_detalle: problema_detalle,
                selecciones: selecciones
            };

            // Enviar la solicitud AJAX para guardar los datos del formulario
            $.ajax({
                type: 'PUT',
                url: "{{ route('updatePatient.actualiza', ['valor' => ':id']) }}".replace(':id',
                    pacienteId),
                data: formData,
                success: function(data) {
                    // Después de guardar los datos, llamar a la función para subir imágenes

                    uploadImages();
                    window.location.href = "{{ url('/pacientes') }}";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    
        // Código para previsualizar imágenes al seleccionarlas
        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            const noImagesMessage = document.getElementById('no-images');
            // Verificar si el contenedor existe
            if (previewContainer) {
                // Si no hay imágenes previas, ocultar el mensaje correspondiente
                if (noImagesMessage) {
                    noImagesMessage.style.display = 'none';
                }

                // Iterar sobre cada archivo seleccionado
                Array.from(files).forEach(file => {
                    if (file) {
                        // Crear contenedor para la imagen y el botón de eliminar
                        const container = document.createElement('div');
                        container.classList.add('image-container');

                        // Crear elemento de imagen
                        const imgElement = document.createElement('img');
                        imgElement.classList.add('preview-image');

                        // Crear URL temporal para la imagen seleccionada
                        const url = URL.createObjectURL(file);
                        imgElement.src = url;

                        // Crear botón de eliminar
                        const deleteButton = document.createElement('button');
                        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'top-2',
                            'rounded');
                        deleteButton.innerHTML = '<span class="bg-danger">X</span>';
                        deleteButton.addEventListener('click', function() {
                            container
                                .remove(); // Eliminar imagen y botón de eliminar al hacer clic
                        });

                        // Agregar la imagen y el botón de eliminar al contenedor
                        container.appendChild(imgElement);
                        container.appendChild(deleteButton);

                        // Agregar el contenedor al contenedor de vista previa
                        previewContainer.appendChild(container);
                    }
                });
            }
        });

        function uploadImages() {
            const files = document.getElementById('images').files;
            const formData = new FormData();

            if (files.length === 0) {
                return;
            } else {
                // Obtener el ID del paciente actual del campo de entrada oculto
                var pacienteId = $('#pacienteId').val();

                for (const file of files) {
                    formData.append('images[]', file);
                }
                // Agregar el ID del paciente al formData
                formData.append('paciente_id', pacienteId);

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
