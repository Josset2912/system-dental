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
use App\Models\CotizacionDetalle;
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
                          <button type="submit" id="levantarModal" class="btn btn-sm btn-light levantarModal">👁</button>
                          <button type="button" class="btn btn-sm btn-success editarCotizacion" data-id="' . $cotizacion->id . '">Editar</button>
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
                    'fechaupdate' => $cotizacion->updated_at ,
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
         // Crear la cotización principal
         $cotizacion = new Cotizaciones();

         $cotizacion->fecha = $request->fecha;
         $cotizacion->nombres = $request->nombres;
         $cotizacion->telefono = $request->telefono;
         $cotizacion->save();
 
         // Obtener el ID de la cotización creada
         $cotizacionId = $cotizacion->id;
 
         // Crear detalles de tratamiento asociados a la cotización
         foreach ($request->tratamientos as $tratamiento) {
             $detalle = new CotizacionDetalle();
             $detalle->id_cotizacion  = $cotizacionId; // Asociar con la cotización creada
             $detalle->tratamiento = $tratamiento['tratamiento'];
             $detalle->presupuesto = $tratamiento['presupuesto'];
             $detalle->save();
         }
 
         // Devolver respuesta JSON con éxito y el ID de la cotización
         return response()->json([
             'success' => true,
             'message' => 'Cotización creada exitosamente',
             'id' => $cotizacionId
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
             // Obtener la cotización principal
            $cotizacion = Cotizaciones::findOrFail($id);
            // Obtener los detalles de la cotización desde CotizacionDetalle
            $detalles = CotizacionDetalle::where('id_cotizacion', $id)->get();
            return response()->json([
                'success' => true,
                'cotizacion' => $cotizacion,
                'detalles' => $detalles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al obtener los datos de la cotización: ' . $e->getMessage()
            ]);
        }
    }

    public function update2(Request $request, $id)
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

    public function update(Request $request, $id)
{
    // Iniciar una transacción para asegurar la consistencia de los datos

    try {
        // Actualizar la cotización principal
       
         // Actualizar la cotización principal
         $cotizacion = Cotizaciones::findOrFail($id);
         $cotizacion->fecha = $request->fecha;
         $cotizacion->nombres = $request->nombres;
         $cotizacion->telefono = $request->telefono;
         $cotizacion->save();
 
         // Eliminar todos los detalles actuales de la cotización
         CotizacionDetalle::where('id_cotizacion', $id)->delete();
 
         // Guardar los nuevos detalles enviados en la solicitud
         if ($request->has('tratamiento')) {
             $tratamientos = $request->tratamiento;
 
             foreach ($tratamientos as $tratamiento) {
                 $detalle = new CotizacionDetalle();
                 $detalle->id_cotizacion = $id;
                 $detalle->tratamiento = $tratamiento['tratamiento'];
                 $detalle->presupuesto = $tratamiento['presupuesto'];
                 $detalle->save();
             }
         }
 

        // Confirmar la transacción si todo fue exitoso

        return response()->json([
            'success' => true,
            'message' => 'Cotización actualizada correctamente.'
        ]);
    } catch (\Exception $e) {
        // Deshacer la transacción en caso de error

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
