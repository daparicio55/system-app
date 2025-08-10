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

    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'catalogo_venta')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFechaAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function getTotalAttribute()
    {
        return $this->catalogos->sum(function ($catalogo) {
            return $catalogo->pivot->cantidad * $catalogo->pivot->precio_unitario;
        });
    }
}
