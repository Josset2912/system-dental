<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Patient;
use App\Models\PatientDetalle;
use Illuminate\Http\Request;
use App\Models\User;



class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = Patient::orderBy('id_paciente', 'desc')->get();
            $dataPacientes = [];
    
            foreach ($patients as $patient) {
                $editar = '
                    <div class="inline-flex">
                        <button type="submit" id="levantarModal" class="btn btn-sm btn-success levantarModal">👁</button>
                        <a href="' . route("editar.index", ["id" => $patient->id_paciente]) . '"class="btn btn-sm btn-primary">Editar</a>
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        <span>
                        
                        <span/>
                    </div>
                ';
                $arrayPacientes = [
                    'nombres' => $patient->nombres,
                    'estado_civil' => $patient->estado_civil == 1 ? 'Soltero' : 'Casado',
                    'fecha' => $patient->fecha != "" ? $patient->fecha : "sin datos" ,
                    'telefono' => $patient->telefono, 
                    'profesion' => $patient->profesion ? $patient->profesion : "sin datos"  ,
                    'cita' => $patient->cita,
                    'motivo_consulta' => $patient->motivo_consulta ? $patient->motivo_consulta : "sin datos" ,
                    'observaciones' => $patient->observaciones,
                    'acciones'=>$editar
                ];
                array_push($dataPacientes, $arrayPacientes);
            }
    
            return response()->json(['data' => $dataPacientes]);
        }
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function upload(Request $request)
    {
        $paciente_id = $request->input('paciente_id');
        $uploadedImages = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Obtener el nombre original de la imagen
                $originalName = $image->getClientOriginalName();
                
                // Verificar si ya existe una imagen con este nombre para este paciente
                $existingImage = PatientDetalle::where('paciente_id', $paciente_id)
                                               ->where('rutaImagen', 'like', '%' . $originalName)
                                               ->first();
    
                if ($existingImage) {
                    // Si la imagen ya existe, actualizar la ruta
                    $path = $image->storeAs('public/', $originalName);
                    $url = Storage::url($path);
    
                    $existingImage->update([
                        'rutaImagen' => $url,
                    ]);
                } else {
                    // Si la imagen no existe, subir y crear una nueva entrada
                    $path = $image->storeAs('public/', $originalName);
                    $url = Storage::url($path);
    
                    PatientDetalle::create([
                        'paciente_id' => $paciente_id,
                        'rutaImagen' => $url,
                    ]);
                }
    
                $uploadedImages[] = $url;
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Imágenes subidas con éxito',
            'images' => $uploadedImages
        ]);
    }

    public function crear(Request $request)
    {
        $paciente = new Patient();  

        $paciente->nombres = $request->nombres;
        $paciente->fecha = $request->fecha;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->profesion = $request->profesion;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        $paciente->motivo_consulta = $request->motivo;
        $paciente->observaciones = $request->observaciones;
        $paciente->alergico = $request->alergico[0];
        $paciente->alergico_detalle = $request->alergico_detalle;
        $paciente->problema_detalle = $request->problema_detalle;

        $paciente->save();
    }


    public function crearPaciente(){
        return view('patients.create');
    }

    public function edit(Request $request)
    {
        $id_user = $request->id ; 

        $patient = Patient::where('id_paciente' , $id_user)->first();
        
        $data['paciente'] = $patient;

        $rutas_imagenes = PatientDetalle::where('paciente_id', $id_user)->pluck('rutaImagen')->toArray();
    
        // Pasar las rutas de las imágenes a la vista
        $data['rutas_imagenes'] = $rutas_imagenes;

        return view('patients.edit' ,  $data );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function actualiza(Request $request,$valor)
    {

        $paciente = Patient::findOrFail($valor);

        // Actualiza los datos del paciente con los valores del formulario
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->correo = $request->correo;
        $paciente->telefono = $request->telefono;
        $paciente->especialidad = $request->especialidad;
        $paciente->alergias = $request->alergias;
        $paciente->observaciones = $request->observaciones;

        // Guarda los cambios en la base de datos
        $paciente->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
