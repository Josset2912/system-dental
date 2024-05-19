<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use App\Models\Patient;
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
            $patients = Patient::all();
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
                    'apellidos' => $patient->apellidos,
                    'direccion' => $patient->direccion,
                    'correo' => $patient->correo,
                    'telefono' => $patient->telefono, 
                    'especialidad' => $patient->especialidad,
                    'cita' => $patient->cita,
                    'alergias' => $patient->alergias,
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
    public function crear(Request $request)
    {
        $paciente = new Patient();  
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->correo = $request->correo;
        $paciente->telefono = $request->telefono;
        $paciente->especialidad = $request->especialidad;
        $paciente->alergias = $request->alergias;
        $paciente->observaciones = $request->observaciones;

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
