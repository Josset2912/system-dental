<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Patient;
use App\Models\PatientDetalle;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PatientTratamiento;
use App\Models\PatientOdontograma;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $patients = Patient::orderBy('id_paciente', 'desc')->where('estado',1)->get();
            $dataPacientes = [];
    
            foreach ($patients as $patient) {
                $editar = '
                    <div class="inline-flex">
                        <button type="submit" id="levantarModal" class="btn btn-sm btn-light levantarModal">👁</button>
                        <a href="' . route("editar.index", ["id" => $patient->id_paciente]) . '"class="btn btn-sm btn-success">Editar</a>
                         <button type="button" class="btn btn-sm btn-danger eliminarPaciente" data-id="' . $patient->id_paciente . '">Eliminar</button>
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
    public function upload2(Request $request)
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
                    $path = $image->storeAs('public/pacientes', $originalName);
                    $url = Storage::url($path);
    
                    $existingImage->update([
                        'rutaImagen' => $url,
                    ]);
                } else {
                    // Si la imagen no existe, subir y crear una nueva entrada
                    $path = $image->storeAs('public/pacientes', $originalName);
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

    public function upload(Request $request)
    {
        $paciente_id = $request->input('paciente_id');
        $uploadedImages = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $existingImage = PatientDetalle::where('paciente_id', $paciente_id)
                                               ->where('rutaImagen', 'like', '%' . $originalName)
                                               ->first();
    
                if ($existingImage) {
                    $path = $image->storeAs('public/pacientes', $originalName); // Se especifica un subdirectorio para almacenar las imágenes
                    $url = Storage::url($path);
    
                    $existingImage->update([
                        'rutaImagen' => $url,
                    ]);
                } else {
                    $path = $image->storeAs('public/pacientes', $originalName); // Se especifica un subdirectorio para almacenar las imágenes
                    $url = Storage::url($path);
    
                    PatientDetalle::create([
                        'paciente_id' => $paciente_id,
                        'rutaImagen' => $url,
                    ]);
                }
    
                $uploadedImages[] = $url;
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se han subido imágenes',
            ], 400);
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
        $paciente->alergico = isset($request->alergico) && count($request->alergico) > 0 ? $request->alergico[0] : 0;
        $paciente->medicamento = isset($request->medicamento) && count($request->medicamento) > 0 ? $request->medicamento[0] : 0;
        $paciente->problema = isset($request->problema_salud) && count($request->problema_salud) > 0 ? $request->problema_salud[0] : 0;
        $paciente->alergico_detalle = $request->alergico_detalle;
        $paciente->problema_detalle = $request->problema_detalle;

        $paciente->save();
         // Devolver el ID del paciente creado
         $ultimoIdPaciente = Patient::latest()->first()->id_paciente;

         // Devolver el ID del paciente creado en la respuesta JSON
         return response()->json(['id' => $ultimoIdPaciente]);
    }


    public function crearPaciente(){
        return view('patients.create');
    }

    public function edit(Request $request)
    {
        $id_user = $request->id ; 
        $patient = Patient::where('id_paciente' , $id_user)->first();
        $data['paciente'] = $patient;
        $patientOdontograma = PatientOdontograma::where('paciente_id' , $id_user)->first();
        $data['datosOdontograma'] = $patientOdontograma;
        // $rutas_imagenes = PatientDetalle::where('paciente_id', $id_user)->orderBy('created_at','desc')->pluck('rutaImagen')->toArray();
        $rutas_imagenes = PatientDetalle::where('paciente_id', $id_user)
        ->orderBy('created_at', 'desc')
        ->get(['id', 'rutaImagen']);
    
        // Pasar las rutas de las imágenes a la vista
        $data['rutas_imagenes'] = $rutas_imagenes;
        return view('patients.edit' ,  $data );
    }
  
    public function PacienteDetalle($id_paciente)
    {
        // return view('patients.DetallePatient');
        $data['idpaciente'] = $id_paciente;
        return view('patients.DetallePatient', $data);
    }

    public function PatientTratamientoListar($idPaciente)
    {
        if ($idPaciente){
            // $patients = PatientTratamiento::orderBy('id', 'desc')->get();
            $patients = PatientTratamiento::where('id_paciente', $idPaciente)->get();
            $dataPacientes = [];
            foreach ($patients as $patient) {
                $editar = '
                     <div class="inline-flex">
                          <button type="button" class="btn btn-sm btn-success editarTratamiento" data-id="' . $patient->id . '">Editar</button>
                          <button type="submit" class="btn btn-sm btn-danger eliminarTratamiento" data-id="' . $patient->id . '">Eliminar</button>
                        <span>
                        
                        <span/>
                    </div>
                ';
                $arrayPacientes = [
                    'fecha' => $patient->fecha,
                    'tratamiento' => $patient->tratamiento, 
                    'cita' => $patient->cita,
                    'presupuesto' => $patient->presupuesto ,
                    'adelanto' => $patient->adelanto,
                    'saldo' => $patient->saldo,
                    'acciones'=>$editar
                ];
                array_push($dataPacientes, $arrayPacientes);
            }
    
            return response()->json(['data' => $dataPacientes]);
        }
        return view('patients.DetallePatient');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    public function saveTratamiento(Request $request)
    {
        
        $paciente = new PatientTratamiento();  

        $ConsultarPaciente = Patient::where('id_paciente',$request->id_Paciente)->first();

        if ($ConsultarPaciente) {
            $paciente->id_paciente = $request->id_Paciente;
            $paciente->fecha = $request->fecha;
            $paciente->tratamiento = $request->tratamiento;
            $paciente->cita = $request->cita;
            $paciente->presupuesto = $request->presupuesto;
            $paciente->adelanto = $request->adelanto;
            $paciente->saldo = $request->saldo;
            $paciente->save();
            
        return response()->json(['success' => true]);
        }else{
        return response()->json(['success' => false]);
        }
    }

    public function deleteImage(Request $request)
    {
        
        $pacienteId = $request->input('pacienteId');
        $imagenId = $request->input('imagenId');
        
        $imageRecord = PatientDetalle::where('paciente_id', $pacienteId)->where('id', $imagenId)->first();

        if (!$imageRecord) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

        $imageRecord->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }



    public function actualiza(Request $request,$valor)
    {

        // print_r($request->selecciones);
        // abort(400,"hola gente");

        $paciente = Patient::findOrFail($valor);
        $paciente->nombres = $request->nombres;
        $paciente->fecha = $request->fecha;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->profesion = $request->profesion;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        $paciente->motivo_consulta = $request->motivo;
        $paciente->observaciones = $request->observaciones;
        $paciente->alergico = isset($request->alergico) && count($request->alergico) > 0 ? $request->alergico[0] : 0;
        $paciente->medicamento = isset($request->medicamento) && count($request->medicamento) > 0 ? $request->medicamento[0] : 0;
        $paciente->problema = isset($request->problema_salud) && count($request->problema_salud) > 0 ? $request->problema_salud[0] : 0;
        $paciente->alergico_detalle = $request->alergico_detalle;
        $paciente->problema_detalle = $request->problema_detalle;

         // Inicializa un array con todos los campos en 0
         $datosOdontograma = [
            'paciente_id' => $valor,
            'l11' => 0, 'b11' => 0, 't11' => 0, 'c11' => 0, 'r11' => 0,
            'l12' => 0, 'b12' => 0, 't12' => 0, 'c12' => 0, 'r12' => 0,
            'l13' => 0, 'b13' => 0, 't13' => 0, 'c13' => 0, 'r13' => 0,
            'l14' => 0, 'b14' => 0, 't14' => 0, 'c14' => 0, 'r14' => 0,
            'l15' => 0, 'b15' => 0, 't15' => 0, 'c15' => 0, 'r15' => 0,
            'l16' => 0, 'b16' => 0, 't16' => 0, 'c16' => 0, 'r16' => 0,
            'l17' => 0, 'b17' => 0, 't17' => 0, 'c17' => 0, 'r17' => 0,
            'l18' => 0, 'b18' => 0, 't18' => 0, 'c18' => 0, 'r18' => 0,
            'l21' => 0, 'b21' => 0, 't21' => 0, 'c21' => 0, 'r21' => 0,
            'l22' => 0, 'b22' => 0, 't22' => 0, 'c22' => 0, 'r22' => 0,
            'l23' => 0, 'b23' => 0, 't23' => 0, 'c23' => 0, 'r23' => 0,
            'l24' => 0, 'b24' => 0, 't24' => 0, 'c24' => 0, 'r24' => 0,
            'l25' => 0, 'b25' => 0, 't25' => 0, 'c25' => 0, 'r25' => 0,
            'l26' => 0, 'b26' => 0, 't26' => 0, 'c26' => 0, 'r26' => 0,
            'l27' => 0, 'b27' => 0, 't27' => 0, 'c27' => 0, 'r27' => 0,
            'l28' => 0, 'b28' => 0, 't28' => 0, 'c28' => 0, 'r28' => 0,
            'l31' => 0, 'b31' => 0, 't31' => 0, 'c31' => 0, 'r31' => 0,
            'l32' => 0, 'b32' => 0, 't32' => 0, 'c32' => 0, 'r32' => 0,
            'l33' => 0, 'b33' => 0, 't33' => 0, 'c33' => 0, 'r33' => 0,
            'l34' => 0, 'b34' => 0, 't34' => 0, 'c34' => 0, 'r34' => 0,
            'l35' => 0, 'b35' => 0, 't35' => 0, 'c35' => 0, 'r35' => 0,
            'l36' => 0, 'b36' => 0, 't36' => 0, 'c36' => 0, 'r36' => 0,
            'l37' => 0, 'b37' => 0, 't37' => 0, 'c37' => 0, 'r37' => 0,
            'l38' => 0, 'b38' => 0, 't38' => 0, 'c38' => 0, 'r38' => 0,
            'l41' => 0, 'b41' => 0, 't41' => 0, 'c41' => 0, 'r41' => 0,
            'l42' => 0, 'b42' => 0, 't42' => 0, 'c42' => 0, 'r42' => 0,
            'l43' => 0, 'b43' => 0, 't43' => 0, 'c43' => 0, 'r43' => 0,
            'l44' => 0, 'b44' => 0, 't44' => 0, 'c44' => 0, 'r44' => 0,
            'l45' => 0, 'b45' => 0, 't45' => 0, 'c45' => 0, 'r45' => 0,
            'l46' => 0, 'b46' => 0, 't46' => 0, 'c46' => 0, 'r46' => 0,
            'l47' => 0, 'b47' => 0, 't47' => 0, 'c47' => 0, 'r47' => 0,
            'l48' => 0, 'b48' => 0, 't48' => 0, 'c48' => 0, 'r48' => 0,
            'lleche51' => 0, 'bleche51' => 0, 'tleche51' => 0, 'cleche51' => 0, 'rleche51' => 0,
            'lleche52' => 0, 'bleche52' => 0, 'tleche52' => 0, 'cleche52' => 0, 'rleche52' => 0,
            'lleche53' => 0, 'bleche53' => 0, 'tleche53' => 0, 'cleche53' => 0, 'rleche53' => 0,
            'lleche54' => 0, 'bleche54' => 0, 'tleche54' => 0, 'cleche54' => 0, 'rleche54' => 0,
            'lleche55' => 0, 'bleche55' => 0, 'tleche55' => 0, 'cleche55' => 0, 'rleche55' => 0,
            'lleche61' => 0, 'bleche61' => 0, 'tleche61' => 0, 'cleche61' => 0, 'rleche61' => 0,
            'lleche62' => 0, 'bleche62' => 0, 'tleche62' => 0, 'cleche62' => 0, 'rleche62' => 0,
            'lleche63' => 0, 'bleche63' => 0, 'tleche63' => 0, 'cleche63' => 0, 'rleche63' => 0,
            'lleche64' => 0, 'bleche64' => 0, 'tleche64' => 0, 'cleche64' => 0, 'rleche64' => 0,
            'lleche65' => 0, 'bleche65' => 0, 'tleche65' => 0, 'cleche65' => 0, 'rleche65' => 0,
            'lleche71' => 0, 'bleche71' => 0, 'tleche71' => 0, 'cleche71' => 0, 'rleche71' => 0,
            'lleche72' => 0, 'bleche72' => 0, 'tleche72' => 0, 'cleche72' => 0, 'rleche72' => 0,
            'lleche73' => 0, 'bleche73' => 0, 'tleche73' => 0, 'cleche73' => 0, 'rleche73' => 0,
            'lleche74' => 0, 'bleche74' => 0, 'tleche74' => 0, 'cleche74' => 0, 'rleche74' => 0,
            'lleche75' => 0, 'bleche75' => 0, 'tleche75' => 0, 'cleche75' => 0, 'rleche75' => 0,
            'lleche81' => 0, 'bleche81' => 0, 'tleche81' => 0, 'cleche81' => 0, 'rleche81' => 0,
            'lleche82' => 0, 'bleche82' => 0, 'tleche82' => 0, 'cleche82' => 0, 'rleche82' => 0,
            'lleche83' => 0, 'bleche83' => 0, 'tleche83' => 0, 'cleche83' => 0, 'rleche83' => 0,
            'lleche84' => 0, 'bleche84' => 0, 'tleche84' => 0, 'cleche84' => 0, 'rleche84' => 0,
            'lleche85' => 0, 'bleche85' => 0, 'tleche85' => 0, 'cleche85' => 0, 'rleche85' => 0,
        ];

        // Verifica si 'selecciones' existe y no está vacío
        if (isset($request->selecciones) && !empty($request->selecciones)) {
            // Procesa las selecciones y actualiza los valores en datosOdontograma
            foreach ($request->selecciones as $seleccion) {
                // Verifica si la clave existe en datosOdontograma
                if (isset($datosOdontograma[$seleccion['id']])) {
                    $datosOdontograma[$seleccion['id']] = $seleccion['valor'];
                }
            }
        }

          // Actualiza o crea el registro en PatientOdontograma
        $odontograma = PatientOdontograma::updateOrCreate(
            ['paciente_id' => $valor],
            $datosOdontograma
        );

       
        $paciente->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {   
        $paciente = Patient::find($request->id);
        if ($paciente) {
            // Cambiar el estado a 0 en lugar de eliminar el registro
            $paciente->estado = 0;
            $paciente->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    // Detalle de tratamiento
    public function listar($id)
    {
        try {
            $patienTratamiento = PatientTratamiento::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $patienTratamiento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al obtener los datos de la cotización: ' . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $tratamiento = PatientTratamiento::findOrFail($id);

            $tratamiento->fecha = $request->fecha;
            $tratamiento->tratamiento = $request->tratamiento;
            $tratamiento->cita = $request->cita;
            $tratamiento->presupuesto = $request->presupuesto;
            $tratamiento->adelanto = $request->adelanto;
            $tratamiento->saldo = $request->saldo;

            $tratamiento->save();

            return response()->json([
                'success' => true,
                'message' => 'Tratamiento actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar la Tratamiento: ' . $e->getMessage()
            ]);
        }
    }

    public function destroyTratamiento(Request $request)
    {
        $tratamiento = PatientTratamiento::find($request->id);
    
        if ($tratamiento) {
            $tratamiento->delete();
            return response()->json(['success' => true, 'message' => 'Cotización eliminada correctamente.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Cotización no encontrada.']);
        }
    }

}
