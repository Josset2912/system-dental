<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\CotizacionesController;




Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//rutas especialidades
Route::get('/especialidades', [App\Http\Controllers\SpecialtyController::class, 'index']);

Route::get('/especialidades/create', [App\Http\Controllers\SpecialtyController::class, 'create']);
Route::get('/especialidades/{specialty}/edit', [App\Http\Controllers\SpecialtyController::class, 'edit']);
Route::post('/especialidades', [App\Http\Controllers\SpecialtyController::class, 'sendData']);
Route::put('/especialidades/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'update']);
Route::post('/especialidades/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'destroy']);

// pacientes
// Route::get('/pacientes', [App\Http\Controllers\SpecialtyController::class, 'index']);

// Route::get('/pacientes', [PatientController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes/creacion', [PatientController::class, 'crearPaciente'])->name('crearPaciente.index');

Route::get('/pacienteDetalle/detalle/{id_paciente}', [PatientController::class, 'PacienteDetalle'])->name('PacienteDetalle.tratamiento');

Route::get('/PatientTratamientoListar/{idPaciente}', [PatientController::class, 'PatientTratamientoListar'])->name('PatientTratamientoListar.tratamiento');
Route::get('/PatientTratamientoListar/listar/{id}', [PatientController::class, 'listar'])->name('listar.tratamiento');
Route::put('/PatientTratamientoListar/actualizar/{id}', [PatientController::class, 'update'])->name('actualizar.tratamiento');
Route::delete('/PatientTratamientoListar/eliminar/', [PatientController::class, 'destroyTratamiento'])->name('eliminar.tratamiento');


Route::post('/upload', [PatientController::class, 'upload'])->name('upload');

Route::post('/pacienteDetalle/crear', [PatientController::class, 'saveTratamiento'])->name('saveTratamiento.index');

Route::post('/pacientes/eliminar', [PatientController::class, 'deleteImage'])->name('deleteImage.index');

Route::get('/pacientes/editar/', [PatientController::class, 'edit'])->name('editar.index');

Route::put('/pacientes/editar/{valor}', [PatientController::class, 'actualiza'])->name('updatePatient.actualiza');

Route::post('/pacientes/crear/', [PatientController::class, 'crear'])->name('createPatient.crear');

Route::delete('/pacientes/eliminar', [PatientController::class, 'destroy'])->name('eliminarPaciente');

//Rutas Pacientes
Route::resource('pacientes', 'App\Http\Controllers\PatientController');


// cotizaciones

Route::get('/cotizaciones/', [CotizacionesController::class, 'index'])->name('inicio.index');

Route::get('/cotizaciones/listar/{id}', [CotizacionesController::class, 'listar'])->name('listar.cotizacion');

Route::post('/cotizaciones/', [CotizacionesController::class, 'crear'])->name('crear.cotizacion');

Route::put('/cotizaciones/actualizar/{id}', [CotizacionesController::class, 'update'])->name('actualizar.cotizacion');

Route::delete('/cotizaciones/eliminar/', [CotizacionesController::class, 'destroy'])->name('eliminar.cotizacion');

