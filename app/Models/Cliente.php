<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'dni_ruc',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'direccion',
        'telefono',
        'email'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
    
}
