<?php

namespace App\Livewire\Administrador\Categorias;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categoria_id;
    public $array_categoria = [
        'nombre' => '',
        'descripcion' => '',
        'categoria_id' => '',
    ];

    public $parent_categories=[];

    public $search;
    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;

    public function create(){
        $this->reset(['categoria_id', 'array_categoria']);
        $this->parent_categories = Categoria::orderBy('nombre','asc')
            ->get();
        $this->modal_create = true;
    }

    public function store(){
        $this->validate([
            'array_categoria.nombre' => 'required|unique:categorias,nombre|max:255',
            'array_categoria.descripcion' => 'nullable|string|max:255',
            'array_categoria.categoria_id' => 'nullable|exists:categorias,id',
        ]);

        if (empty($this->array_categoria['categoria_id'])) {
            $this->array_categoria['categoria_id'] = null; // Set to null if no parent category is selected
        }

        Categoria::create($this->array_categoria);
        $this->modal_create = false;
    }

    public function edit($id){
        $this->categoria_id = $id;
        $this->parent_categories = Categoria::orderBy('nombre','asc')
            ->where('id', '!=', $id) // Exclude the current category from the parent categories 
            ->get();
        $this->array_categoria = Categoria::find($id)->toArray();
        $this->modal_edit = true;
    }

    public function update($id){
        $this->validate([
            'array_categoria.nombre' => 'required|unique:categorias,nombre,' . $id . '|max:255',
            'array_categoria.descripcion' => 'nullable|string|max:255',
        ]);

        $categoria = Categoria::find($id);
        if (empty($this->array_categoria['categoria_id'])) {
            $this->array_categoria['categoria_id'] = null; // Set to null if no parent category is selected
        }
        $categoria->update($this->array_categoria);
        $this->modal_edit = false;
    }
    
    public function deleteConfirmation($id){
        $this->categoria_id = $id;
        $this->array_categoria = Categoria::find($id)->toArray();
        $this->modal_delete = true;
    }

    public function delete($id){
        Categoria::destroy($id);
        $this->modal_delete = false;
    }

    public function render()
    {
        $categorias = Categoria::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nombre')
            ->paginate(10);
        
        return view('livewire.administrador.categorias.index',compact('categorias'));
    }
}
