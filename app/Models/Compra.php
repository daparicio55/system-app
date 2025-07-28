<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //

    protected $fillable = [
        'numero_factura',
        'fecha',
        'igv',
        'pagado',
        'user_id',
        'proveedore_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proveedore(){
        return $this->belongsTo(Proveedore::class, 'proveedore_id');
    }

    //obtenemos la fecha de la compra en formato d/m/Y
    public function getFechaAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'catalogo_compra', 'compra_id', 'catalogo_id')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }

    public function getSubtotalAttribute(){
        return $this->catalogos->sum(function ($catalogo) {
            return $catalogo->pivot->cantidad * $catalogo->pivot->precio_unitario;
        });
    }

    public function getIgvtotalAttribute()
    {
        if ($this->igv){
            return $this->subtotal * 0.18;
        }else {
            return 0;
        }
        
    }
}
