<?php

namespace App;

use App\Models\Marca;

trait MarcaTrait
{
    public $array_marca = [
        'nombre' => '',
        'descripcion' => ''
    ];

    public $modal_create_marca = false;

    public function modalCreateMarca()
    {
        $this->modal_create_marca = true;
    }

    public function store_marca()
    {
        $this->validate([
            'array_marca.nombre' => 'required|string|max:255|unique:marcas,nombre',
            'array_marca.descripcion' => 'nullable|string|max:255',
        ]);

        Marca::create($this->array_marca);
        $this->modal_create_marca = false;

        $this->reset('array_marca');

        // Check if there is a public variable called marcas
        if (property_exists($this, 'marcas')) {
            $this->marcas = Marca::orderBy('nombre', 'asc')->get();
        }

        session()->flash('message', 'Marca creada exitosamente.');
    }
}
