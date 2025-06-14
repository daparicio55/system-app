<?php

namespace App;

use App\Models\Medida;

trait MedidaTrait
{
    public $array_medida = [
        'nombre' => '',
        'abreviatura' => ''
    ];

    public $modal_create_medida = false;

    public function modalCreateMedida(){
        $this->reset(['array_medida']);
        $this->modal_create_medida = true;
    }

    public function store_medida(){
        $this->validate([
            'array_medida.nombre' => 'required|string|max:255',
            'array_medida.abreviatura' => 'required|string|max:255',
        ]);

        Medida::create($this->array_medida);

        $this->reset(['array_medida']);

        // Check if there is a public variable called medidas
        if (property_exists($this, 'medidas')) {
            $this->medidas = Medida::orderBy('nombre', 'asc')->get();
        }

        $this->modal_create_medida = false;

        session()->flash('message', 'Medida creada exitosamente.');
    }
}
