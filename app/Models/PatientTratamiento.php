<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTratamiento extends Model
{
    use HasFactory;

    protected $table = 'patientratamiento';

    protected $primaryKey = 'id';

    protected $fillable = [
       'id_paciente',
       'fecha',
       'tratamiento	',
       'cita',
       'presupuesto',
       'adelanto',
       'saldo',
       'created_at',
       'updated_at',


    ];

     /* Query Scopes */
 
}
