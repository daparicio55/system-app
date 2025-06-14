<?php

namespace App\Livewire\Administrador\Catalogos;

use App\CategoriaTrait;
use App\MarcaTrait;
use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\Component;

class Index extends Component
{
    use CategoriaTrait;
    use MarcaTrait;

    public $catalogo_id;
    public $array_catalogo = [
        'codigo' => '',
        'nombre' => '',
        'descripcion' => '',
        'categoria_id' => '',
        'marca_id' => '',
        'medida_id' => '',
        'activo' => true,
        'precio' => 0.00,
    ];

    public $categorias = [];
    public $marcas = [];

    public $search;
    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;

    public function create()
    {
        $this->reset(['catalogo_id', 'array_catalogo']);
        $this->categorias = Categoria::orderBy('nombre', 'asc')
            ->get();
        $this->marcas = Marca::orderBy('nombre', 'asc')
            ->get();
        $this->modal_create = true;
    }
    

    public function render()
    {
        $catalogos = Catalogo::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nombre')
            ->paginate(10);
        return view('livewire.administrador.catalogos.index', compact('catalogos'));
    }
}
