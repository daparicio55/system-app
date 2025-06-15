<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'categoria_id',
        'marca_id',
        'medida_id',
        'activo',
        'precio',
        'contiene',
        'image_path',
        'catalogo_id',
    ];

    public function getPrecioAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }
    
    public function parent()
    {
        return $this->belongsTo(Catalogo::class, 'catalogo_id');
    }
    
    public function children()
    {
        return $this->hasOne(Catalogo::class, 'catalogo_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    public function medida()
    {
        return $this->belongsTo(Medida::class);
    }
}
