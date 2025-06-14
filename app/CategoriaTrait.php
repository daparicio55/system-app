<?php

namespace App;

use App\Models\Categoria;

trait CategoriaTrait
{
    public $array_categoria = [
        'nombre' => '',
        'descripcion' => '',
        'categoria_id' => null, // Default to null for no parent category
    ];

    public $modal_create_categoria = false;

    public function modalCreateCategoria()
    {
        $this->modal_create_categoria = true;
    }

    public function store_categoria()
    {
        $this->validate([
            'array_categoria.nombre' => 'required|unique:categorias,nombre|max:255',
            'array_categoria.descripcion' => 'nullable|string|max:255',
            'array_categoria.categoria_id' => 'nullable|exists:categorias,id',
        ]);

        if (empty($this->array_categoria['categoria_id'])) {
            $this->array_categoria['categoria_id'] = null; // Set to null if no parent category is selected
        }

        Categoria::create($this->array_categoria);
        $this->modal_create_categoria = false;

        $this->reset('array_categoria');
        
        //verifico si hay una variable publica llamada categorias
        if (property_exists($this, 'categorias')) {
            $this->categorias = Categoria::orderBy('nombre', 'asc')->get();
        }
        
    }
}
