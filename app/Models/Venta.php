<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = [
        'cliente_id',
        'user_id',
        'fecha',
        'tipo_comprobante',
        'numero',
        'tipo_pago',
    ];
}
