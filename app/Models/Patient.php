<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_paciente';

    protected $fillable = [
        'nombres',
        'apellidos',
        'direccion',
        'correo',
        'telefono',
        'especialidad',
        'cita',
        'alergias',
        'observaciones',
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
