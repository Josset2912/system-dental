<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;

    protected $table = 'cotizacion';

    protected $primaryKey = 'id';

    protected $fillable = [
       'fecha',
       'nombres',
       'telefono',
       'tratamiento',
       'presupuesto',
    ];

     /* Query Scopes */
 
}
