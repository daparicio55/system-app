<?php

namespace App\Livewire\Administrador\Catalogos;

use App\CatalogoTrait;
use App\CategoriaTrait;
use App\MarcaTrait;
use App\MedidaTrait;
use App\Models\Catalogo;
use Livewire\Component;

class Index extends Component
{
    use CategoriaTrait;
    use MarcaTrait;
    use MedidaTrait;
    use CatalogoTrait;

    public $catalogo_id;

    public $search;


    public $modal_edit = false;
    public $modal_delete = false;

    public function mount()
    {
        $this->getDataToSelects();
    }

    public function deleteConfirmation($id)
    {
        $this->catalogo_id = $id;
        $this->array_catalogo = Catalogo::find($id)->toArray();
        $this->modal_delete = true;
    }

    public function delete($id)
    {
        Catalogo::destroy($id);
        $this->modal_delete = false;
    }

    public function edit($id)
    {

        $this->reset(['array_catalogo']);

        $this->catalogo_id = $id;

        $catalogo = Catalogo::find($id);

        $this->array_catalogo = [
            'id' => $catalogo->id,
            'codigo' => $catalogo->codigo,
            'nombre' => $catalogo->nombre,
            'descripcion' => $catalogo->descripcion,
            'contiene' => $catalogo->contiene,
            'precio' => $catalogo->precio,
            'activo' => $catalogo->activo,
            'image_path' => $catalogo->image_path,
            'categoria_id' => $catalogo->categoria_id,
            'marca_id' => $catalogo->marca_id,
            'medida_id' => $catalogo->medida_id,
        ];
        if (isset($catalogo->catalogo_id)) {
            $this->array_catalogo['catalogo_id'] = $catalogo->catalogo_id;
        }

        $this->modal_edit = true;
    }

    public function update($id)
    {
        $this->validate([
            'array_catalogo.codigo' => 'required|string|max:255|unique:catalogos,codigo,' . $id,
            'array_catalogo.nombre' => 'required|string|max:255',
            'array_catalogo.descripcion' => 'required|string|max:255',
            'array_catalogo.categoria_id' => 'required|exists:categorias,id',
            'array_catalogo.marca_id' => 'required|exists:marcas,id',
            'array_catalogo.medida_id' => 'required|exists:medidas,id',
            'array_catalogo.precio' => 'required|numeric|min:0',
        ]);

        $catalogo = Catalogo::find($id);

        if(empty($this->array_catalogo['catalogo_id'])) {
            $this->array_catalogo['catalogo_id'] = null; // Set to null if no parent catalog is selected
        }
        $catalogo->update($this->array_catalogo);

        $this->modal_edit = false;
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
