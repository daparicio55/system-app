<?php

namespace App;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Medida;

trait CatalogoTrait
{
    public $array_catalogo = [];

    public $categorias = [];
    public $marcas = [];
    public $medidas = [];

    public $modal_create_catalogo = false;

    public function modalCreateCatalogo()
    {
        $this->reset(['array_catalogo']);

        $this->reset(['catalogo_id', 'array_catalogo']);

        $this->getDataToSelects();

        $this->modal_create_catalogo = true;
    }

    public function getDataToSelects(){
        $this->categorias = Categoria::orderBy('nombre', 'asc')
            ->get()->toArray();

        $this->marcas = Marca::orderBy('nombre', 'asc')
            ->get()->toArray();

        $this->medidas = Medida::orderBy('nombre', 'asc')
            ->get()->toArray();
    }


    public function setCatalogoPadre()
    {

        $catalogo = Catalogo::find($this->array_catalogo['catalogo_id']);
        $this->array_catalogo = [
            'marca_id' => $catalogo->marca_id,
            'categoria_id' => $catalogo->categoria_id,
            'nombre' => $catalogo->nombre,
            'descripcion' => $catalogo->descripcion,
            'catalogo_id' => $catalogo->id,
        ];
    }

    public function store_catalogo()
    {
        $this->validate([
            'array_catalogo.codigo' => 'required|string|max:255|unique:catalogos,codigo',
            'array_catalogo.nombre' => 'required|string|max:255',
            'array_catalogo.descripcion' => 'required|string|max:255',
            'array_catalogo.categoria_id' => 'required|exists:categorias,id',
            'array_catalogo.marca_id' => 'required|exists:marcas,id',
            'array_catalogo.medida_id' => 'required|exists:medidas,id',
            'array_catalogo.precio' => 'required|numeric|min:0',
        ]);

        Catalogo::create($this->array_catalogo);

        $this->reset(['array_catalogo']);

        //verifico si hay una variable publica llamada catalogos
        if (property_exists($this, 'catalogos')) {
            $this->catalogos = Catalogo::orderBy('nombre', 'asc')->get();
        }

        $this->modal_create_catalogo = false;

        session()->flash('message', 'Catálogo creado exitosamente.');
    }
}
