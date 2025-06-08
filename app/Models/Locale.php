<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    //
    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'telefono'
    ];
}
