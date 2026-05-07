<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usariosapp extends Model
{
    protected $table = 'Usariosapp';

    protected $fillable = [
        'nombre',
        'correo',
        'dpi',
        'password',
        'rango_receta',
        'receta_opinion',
        'receta_imagen',
    ];
}
