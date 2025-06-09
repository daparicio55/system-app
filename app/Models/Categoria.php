<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
    ];

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_id');
    }
    
    public function parentCategoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
