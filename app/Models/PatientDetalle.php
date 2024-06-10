<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientDetalle extends Model
{
    use HasFactory;

    protected $table = 'patientdetalle';

    protected $primaryKey = 'id';

    protected $fillable = [
       'paciente_id',
       'rutaImagen',
    ];

     /* Query Scopes */
 
}
