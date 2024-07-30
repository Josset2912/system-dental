@extends('layouts.panel')
@php
    use Illuminate\Support\Str;
@endphp

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

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
        width: 150px;
        height: 150px;
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
        background-color: blue !important;
    }

    .click-delete {
        background-color: #747F7D !important;
    }

    .click-extraido {
        background-color: #11cdef !important;
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

    .invisible-radio {
            display: none;
    }
    .opacity-50 {
        opacity: 0.5;
    }

    #modalImage {
        width: 900px;
        height: 700px;
        /* object-fit: cover;  */
        object-fit: fill;
        border-radius:15px;
        left:100px;
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
                <a class="btn btn-dark btn-sm m-3"
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
                <div>
                    <span>* Subir solo imagenes en formato: JPG, PNG, JPEG</span>
                </div>
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
                                <input type="file" class="form-control" name="images[]" id="images" accept="image/*" multiple>
                            </div>
                            <div>
                                @if (!empty($rutas_imagenes))
                                    <div class="preview-container row" id="preview-container">
                                        @foreach ($rutas_imagenes as $ruta_imagen)
                                            <div class="">
                                                <input type="text" class="d-none IdImagenes" value="{{ $ruta_imagen->id }}" id="imagen-{{ $ruta_imagen->id }}">
                                                <img src="{{ $ruta_imagen->rutaImagen  }}" alt="Imagen del paciente"
                                                    class="preview-image" style="cursor:pointer">
                                                <input type="button" 
                                                    class="btn btn-danger " 
                                                    onclick="deleteImage('{{ $ruta_imagen->rutaImagen }}', {{ $ruta_imagen->id }})" 
                                                    style="width:15px;border: none; padding: 0;" 
                                                    value="X"
                                                >
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
                        <div class="container border">
                            <div class="panel panel-primary">
                                
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                </div>

                                <div class="d-flex flex-column ">
                                    <div class="row m-5">
                                        <div class="col-md-6 mx-auto" id="controls">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label id="fractura" class="btn btn-danger active ">
                                                    <input type="radio" name="options" id="option1"  autocomplete="off" class="invisible-radio"  checked>Fractura
                                                </label>

                                                <label id="restauracion" class="btn btn-primary" >
                                                    <input type="radio" name="options" id="option2"  autocomplete="off" class="invisible-radio" > Obturación
                                                </label>

                                                <label id="extraccion" class="btn btn-secondary" >
                                                    <input type="radio" name="options" id="option3" autocomplete="off" class="invisible-radio" > Extracción
                                                </label>

                                                <label id="extraer" class="btn btn-warning " >
                                                    <input type="radio" name="options" id="option4" autocomplete="off" class="invisible-radio" > A Extraer
                                                </label>

                                                <label id="extraido" class="btn btn-info " >
                                                    <input type="radio" name="options" id="option5" autocomplete="off" class="invisible-radio" > Diente ausente
                                                </label>

                                                <!-- <label id="puente" class="btn btn-primary">
                                                    <input type="radio" name="options" id="option5" autocomplete="off" class="invisible-radio" > Puente
                                                </label> -->
                                                <!-- <label id="borrar" class="btn btn-default">
                                                    <input type="radio" name="options" id="option6" autocomplete="off" class="invisible-radio" > Borrar
                                                </label> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div id="tr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                        <div id="tl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                        <div id="tlr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                        </div>
                                        <div id="tll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div id="blr" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                        </div>
                                        <div id="bll" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                        <div id="br" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                        <div id="bl" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-around mt-5 mb-4 ">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left">
                                            <div style="height: 20px; width:20px; display:inline-block;" class="click-red"></div> = Fractura/Carie
                                            <br>
                                            <div style="height: 5px; width:20px; display:inline-block;" class=""> <i style="color:#11cdef;" class="fa fa-times fa-2x"></i></div> = Diente ausente
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                            <div style="height: 20px; width:20px; display:inline-block;" class="click-blue"></div> = Obturación
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                            <span style="display:inline:block;"> Extracción</span> = <img style="display:inline:block;" src="{{asset('img/extraccion.png')}}">
                                            <br> Idicada Para Extracción = <i style="color:red;" class="fa fa-times fa-2x"></i>
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

                
                <button type="submit" id="guardarBtn" class="btn btn-success"
                    data-id="{{ $paciente->id }}">Actualizar</button>
            </form>
        </div>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="right:100px">
            <!-- <div class="modal-content"> -->
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Imagen en tamaño grande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Imagen del paciente" class="">
                </div>
            <!-- </div> -->
        </div>
    </div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    function deleteImage(imagePath, idImagenes) {
        var pacienteId = $('#pacienteId').val();
        Swal.fire({
            title: "¿Desea eliminar la imagen?",
            // text: "cuidado",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '{{ route('deleteImagen.paciente') }}', 
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    pacienteId: pacienteId,
                    imagenId: idImagenes
                },
                success: function(response) {
                    if (response.success) {
                       
                        Swal.fire({
                            position: "center-start",
                            icon: "success",
                            title: "Eliminado correctamente",
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            // Recargar la página después de que se cierre el Swal
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // Puedes ajustar el tiempo de espera si es necesario
                        });

                        // location.reload(); 
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
        });
        
         // Swal.fire({
        // title: "Deleted!",
        // text: "Your file has been deleted.",
        // icon: "success"
        // });
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
                '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="badge badge-info">index' + index + '</span>' +
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
                '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="badge badge-info">index' + a + '</span>' +
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
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="badge badge-primary">index' + i + '</span>' +
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
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="badge badge-primary">index' + a + '</span>' +
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
            else if (datosBd[key] == 2) {
                var id = key.replace('_', '');
             $('#' + id).addClass('click-blue').addClass('selected');
            }
            else if (datosBd[key] == 3) {
                var id = key.replace('_', '');
             $('#' + id).addClass('click-delete').addClass('selected');
            }
            else if (datosBd[key] == 4){
                var id = key.replace('_', '');
                var element = $('#' + id);
                // Asegurar que el elemento tiene posición relativa
                element.css({
                    'position': 'relative',
                    'z-index': '1'
                });
                var icon;

                if (element.hasClass("centro-leche")) {
                    console.log("centrooo");
                    icon = $('<i style="color:red;" class="fa fa-times fa-2x fa-fw"></i>');
                    icon.css({
                        "position": "absolute",
                        "top": "-10",
                        "left": "-15",
                        "z-index": "99"
                    });
                } else {
                    console.log("centro-lecheeeee");
                    icon = $('<i style="color:red;" class="fa fa-times fa-3x fa-fw"></i>');
                    icon.css({
                       "position": "absolute",
                       "top": "-13",
                       "left": "-18",
                        "z-index": "99"
                    });
                }
                element.append(icon);
            }
            else if (datosBd[key] == 5){
                var id = key.replace('_', '');
                var element = $('#' + id);
                // console.log(element);
                var icon;
                if (element.hasClass("centro-leche")) {
                    console.log("centrooo");
                    icon = $('<i style="color:#11cdef;" class="fa fa-times fa-2x fa-fw"></i>');
                    icon.css({
                        "position": "absolute",
                        "top": "-10",
                        "left": "-15",
                        "z-index": "99"
                    });
                } else {
                    console.log("centro-lecheeeee");
                    icon = $('<i style="color:#11cdef;" class="fa fa-times fa-3x fa-fw"></i>');
                    icon.css({
                       "position": "absolute",
                       "top": "-13",
                       "left": "-18",
                        "z-index": "99"
                    });
                }
                element.append(icon);
            }
        }

        for (var key in datosBd) {
            var id = key.replace('_', '');
            if (datosBd[key] >= 1 && selecciones.indexOf(id) === -1) {
                // selecciones.push(id);
                selecciones.push({ id: id, valor: datosBd[key] });

            }
        }

        selecciones = selecciones.filter(function(item, index, self) {
        return self.indexOf(item) === index;
    });
    }

    var selecciones = [];
    
    var datosBd = {!! json_encode($datosOdontograma) !!};

    var arrayPuente = [];


    window.onload = function() {

        createOdontogram(datosBd,selecciones);

        $(".click").click(function(event) {

            var id = $(this).attr('id');
            var control = $("#controls").children().find('.active').attr('id');
            var cuadro = $(this).find("input[name=cuadro]:hidden").val();
            console.log(id);

            var valor;

            switch (control) {
                case "fractura":
                    valor = 1;
                    if ($(this).hasClass("click-red")) {
                        $(this).removeClass('click-red');
                        $(this).removeClass('selected');
                        var index = selecciones.findIndex(obj => obj.id === id);
                        if (index !== -1) {
                            selecciones.splice(index, 1);
                        }
                    } 
                    else if ($(this).hasClass("click-blue") || $(this).hasClass("click-delete"))
                    {
                        console.log("no hago nada");
                        return;
                    }
                    else {
                        $(this).addClass('click-red');
                        $(this).addClass('selected');
                        selecciones.push({ id: id, valor: valor });
                    }
                    break;
                case "restauracion":
                    valor = 2;
                    if ($(this).hasClass("click-blue")) {
                        $(this).removeClass('click-blue');
                        $(this).removeClass('selected');
                        var index = selecciones.findIndex(obj => obj.id === id);
                        if (index !== -1) {
                            selecciones.splice(index, 1);
                        }
                    } else if ($(this).hasClass("click-red") || $(this).hasClass("click-delete"))
                    {
                        console.log("no hago nada");
                        return;
                    }
                    else{
                        $(this).addClass('click-blue');
                        $(this).addClass('selected');
                        selecciones.push({ id: id, valor: valor });
                    }
                    break;
                case "extraccion":
                    valor = 3;
                    if ($(this).hasClass("click-red") ||  $(this).hasClass("click-blue"))
                    {
                        console.log("no hago nada");
                        return;
                    }
                    else if($(this).hasClass("click-delete")){  
                        $(this).parent().children().each(function(index, el) {
                            if ($(el).hasClass("click")) {
                                $(el).removeClass('click-delete');
                                var childId = $(el).attr('id');
                                var index = selecciones.findIndex(obj => obj.id === childId);
                                if (index !== -1) {
                                    selecciones.splice(index, 1);
                                }
                            }
                        });
                    }
                    else{
                        var dientePosition = $(this).position();
                        $(this).parent().children().each(function(index, el) {
                            if ($(el).hasClass("click")) {
                                $(el).addClass('click-delete');
                                var childId = $(el).attr('id');
                                selecciones.push({ id: childId, valor: valor });
                            }
                        });
                    }
                    break;
                case "extraer":
                    valor = 4;
                    var element = $('#' + id);
                    
                    if ($(this).hasClass("click-red") ||  $(this).hasClass("click-blue") ||  $(this).hasClass("click-delete"))
                    {
                        console.log("no hago nada");
                        return;
                    }
                    // if (!element.hasClass("centro") && !element.hasClass("centro-leche")) {
                    else if(element.find('i').length > 0){
                        element.find('i').remove();
                        var childId = element.attr('id');
                        var index = selecciones.findIndex(obj => obj.id === childId);
                        if (index !== -1) {
                            selecciones.splice(index, 1);
                        }

                    }
                    else if (element.hasClass("centro") || element.hasClass("centro-leche")) {
                        element.css({
                            'position': 'relative',
                            'z-index': '1'
                        });
                        $(this).addClass('selected');
                        var childId = element.attr('id');

                        selecciones.push({ id: childId, valor: valor });

                        var icon;
                        if (element.hasClass("centro")) {
                            icon = $('<i style="color:red;" class="fa fa-times fa-3x fa-fw"></i>');
                            icon.css({
                                "position": "absolute",
                                "top": "-13",
                                "left": "-18",
                                "z-index": "99"
                            });
                        } else {
                            icon = $('<i style="color:red;" class="fa fa-times fa-2x fa-fw"></i>');
                            icon.css({
                                "position": "absolute",
                                "top": "-10",
                                "left": "-15",
                                "z-index": "99"
                            });
                        }
                        element.append(icon);
                    }
                    else{
                        console.log("nadaaaaa");
                    }
                    break;
                case "extraido":
                    valor = 5;
                    var element = $('#' + id);
                     if ($(this).hasClass("click-red") ||  $(this).hasClass("click-blue") ||  $(this).hasClass("click-delete"))
                    {
                        console.log("no hago nada");
                        return;
                    }
                    // if (!element.hasClass("centro") && !element.hasClass("centro-leche")) {
                    else if(element.find('i').length > 0){
                        element.find('i').remove();
                        var childId = element.attr('id');
                        var index = selecciones.findIndex(obj => obj.id === childId);
                        if (index !== -1) {
                            selecciones.splice(index, 1);
                        }

                    }
                    else if (element.hasClass("centro") || element.hasClass("centro-leche")) {
                        element.css({
                            'position': 'relative',
                            'z-index': '1'
                        });
                        $(this).addClass('selected');
                        var childId = element.attr('id');

                        selecciones.push({ id: childId, valor: valor });

                        var icon;
                        if (element.hasClass("centro")) {
                            icon = $('<i style="color:#11cdef;" class="fa fa-times fa-3x fa-fw"></i>');
                            icon.css({
                                "position": "absolute",
                                "top": "-13",
                                "left": "-18",
                                "z-index": "99"
                            });
                        } else {
                            icon = $('<i style="color:#11cdef;" class="fa fa-times fa-2x fa-fw"></i>');
                            icon.css({
                                "position": "absolute",
                                "top": "-10",
                                "left": "-15",
                                "z-index": "99"
                            });
                        }
                        element.append(icon);
                    }
                    else{
                        console.log("nadaaaaa");
                    }
                    break;
                default:
                    valor = 0;
                    break;
            }

            // Mostrar el array en la consola
            console.log("soy selecciones"); 
            console.log(selecciones);

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
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        }

        const previewImages = document.querySelectorAll('.preview-image');
        const modalImage = document.getElementById('modalImage');
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));

        previewImages.forEach(image => {
            image.addEventListener('click', function() {
            modalImage.src = image.src;
            imageModal.show();
            });
        });


    }
</script>
