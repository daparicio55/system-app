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
