<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $fillable = [
        'nombre',
        'abreviatura',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
