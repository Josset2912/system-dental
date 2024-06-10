<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_paciente';

    protected $fillable = [
       'id_paciente',
       'nombres',
       'apellidos',
       'direccion',
       'correo',
       'telefono',
       'profesion',
       'cita',
       'alergias',
       'observaciones',
       'created_at',
       'updated_at',
       'fecha',
       'estado_civil',
       'edad',
       'motivo_consulta',
       'alergico',
       'alergico_detalle',
       'medicamento',
       'problema',
       'problema_detalle',
    ];


     /* Query Scopes */
     public function scopeSearchByNombres($query, $value) {
        if (!is_null($value)) {
            return $query->where('patients.nombres', 'LIKE', "%$value%");
        }
    }

    public function scopeSearchByCorreo($query, $value) {
        if (!is_null($value)) {
            return $query->where('patients.correo', 'LIKE', "%$value%");
        }
    }
}
