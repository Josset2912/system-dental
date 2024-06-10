<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialtyController;




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
Route::delete('/especialidades/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'destroy']);


// pacientes
// Route::get('/pacientes', [App\Http\Controllers\SpecialtyController::class, 'index']);

// Route::get('/pacientes', [PatientController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes/creatividad', [PatientController::class, 'crearPaciente'])->name('crearPaciente.index');

Route::post('/upload', [PatientController::class, 'upload'])->name('upload');


Route::get('/pacientes/editar', [PatientController::class, 'edit'])->name('editar.index');
Route::put('/pacientes/update/{valor}', [PatientController::class, 'actualiza'])->name('updatePatient.actualiza');
Route::post('/pacientes/crear/', [PatientController::class, 'crear'])->name('createPatient.crear');


//Rutas Pacientes
Route::resource('pacientes', 'App\Http\Controllers\PatientController');
