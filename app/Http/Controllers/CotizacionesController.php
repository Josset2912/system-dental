<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Patient;
use App\Models\Cotizaciones;
use App\Models\PatientDetalle;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PatientTratamiento;
use Illuminate\Support\Str; 

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cotizaciones = Cotizaciones::orderBy('id', 'desc')->get();
            $dataPacientes = [];
            foreach ($cotizaciones as $cotizacion) {
                $editar = '
                    <div class="inline-flex">
                          <button type="submit" id="levantarModal" class="btn btn-sm btn-success levantarModal">👁</button>
                          <button type="button" class="btn btn-sm btn-primary editarCotizacion" data-id="' . $cotizacion->id . '">Editar</button>
                          <button type="submit" class="btn btn-sm btn-danger eliminarCotizacion" data-id="' . $cotizacion->id . '">Eliminar</button>
                        <span>
                        
                        <span/>
                    </div>
                ';
                $arrayPacientes = [
                    'fecha' => $cotizacion->fecha != "" ? $cotizacion->fecha : "sin datos" ,
                    'nombres' => $cotizacion->nombres ? $cotizacion->nombres : "sin datos"  ,
                    'telefono' => $cotizacion->telefono, 
                    'tratamiento' => $cotizacion->tratamiento  ?  Str::limit( $cotizacion->tratamiento , 40, '...') : "sin datos" ,
                    'presupuesto' => 'S/.'. $cotizacion->presupuesto .'.00',
                    'acciones'=>$editar
                ];
                array_push($dataPacientes, $arrayPacientes);
            }
            // Str::limit($producto['nombre_producto'], 40, '...')

            return response()->json(['data' => $dataPacientes]);
        }
        return view('Cotizaciones.index');
    }

    public function crear(Request $request)
    {
        try {
            $cotizacion = new Cotizaciones();
    
            $cotizacion->fecha = $request->fecha;
            $cotizacion->nombres = $request->nombres;
            $cotizacion->telefono = $request->telefono;
            $cotizacion->tratamiento = $request->tratamiento;
            $cotizacion->presupuesto = $request->presupuesto;
    
            $cotizacion->save();
    
            // Devolver el ID de la cotización creada en la respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Cotización creada exitosamente',
                'id' => $cotizacion->id
            ]);
        } catch (\Exception $e) {
            // Manejar el error y devolver una respuesta JSON con un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al crear la cotización: ' . $e->getMessage()
            ]);
        }
    }

    public function listar($id)
    {
        try {
            $cotizacion = Cotizaciones::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $cotizacion
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
            $cotizacion = Cotizaciones::findOrFail($id);

            $cotizacion->fecha = $request->fecha;
            $cotizacion->nombres = $request->nombres;
            $cotizacion->telefono = $request->telefono;
            $cotizacion->tratamiento = $request->tratamiento;
            $cotizacion->presupuesto = $request->presupuesto;

            $cotizacion->save();

            return response()->json([
                'success' => true,
                'message' => 'Cotización actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar la cotización: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $cotizacion = Cotizaciones::find($request->id);
    
        if ($cotizacion) {
            $cotizacion->delete();
            return response()->json(['success' => true, 'message' => 'Cotización eliminada correctamente.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Cotización no encontrada.']);
        }
    }


}
