<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'razon_social',
        'nombre_comercial',
        'telefono',
        'email',
        'direccion',
        'contacto',
    ];

    public function getRucAttribute($value)
    {
        return strtoupper($value);
    }

    public function getRazonSocialAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNombreComercialAttribute($value)
    {
        return strtoupper($value);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedore_id');
    }
}
