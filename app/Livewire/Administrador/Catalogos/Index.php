<?php

namespace App\Livewire\Administrador\Catalogos;

use App\CatalogoTrait;
use App\CategoriaTrait;
use App\MarcaTrait;
use App\MedidaTrait;
use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Medida;
use Livewire\Component;

class Index extends Component
{
    use CategoriaTrait;
    use MarcaTrait;
    use MedidaTrait;

    use CatalogoTrait;

    public $catalogo_id;


    public $categorias = [];
    public $marcas = [];
    public $medidas = [];

    public $search;

    
    public $modal_edit = false;
    public $modal_delete = false;

    public function create()
    {
        $this->reset(['catalogo_id', 'array_catalogo']);

        $this->categorias = Categoria::orderBy('nombre', 'asc')
            ->get();

        $this->marcas = Marca::orderBy('nombre', 'asc')
            ->get();

        $this->medidas = Medida::orderBy('nombre', 'asc')
            ->get();

        $this->modal_create_catalogo = true;
    }
    
    public function setCatalogoPadre(){
        
        $catalogo = Catalogo::find($this->array_catalogo['catalogo_id']);
        $this->array_catalogo = [
            'marca_id' => $catalogo->marca_id,
            'categoria_id' => $catalogo->categoria_id,
            'nombre' => $catalogo->nombre,
            'descripcion' => $catalogo->descripcion,
            'catalogo_id' => $catalogo->id,
        ];

    }


    public function store_catalogo(){
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
        $this->modal_create_catalogo = false;

        session()->flash('message', 'Catálogo creado exitosamente.');
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
