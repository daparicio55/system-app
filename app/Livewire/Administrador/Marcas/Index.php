<?php

namespace App\Livewire\Administrador\Marcas;

use App\MarcaTrait;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use MarcaTrait;    

    public $marca_id;

    public $search;
 
    public $modal_edit = false;
    public $modal_delete = false;

    public function create(){
        $this->reset(['array_marca', 'marca_id']);
        $this->modal_create_marca = true;
    }

    public function edit($id){
        $this->marca_id = $id;
        $this->array_marca = Marca::findOrFail($id)->toArray();
        $this->modal_edit = true;
    }

    public function update($id){
        $this->validate([
            'array_marca.nombre' => 'required|string|max:255|unique:marcas,nombre,' . $id,
            'array_marca.descripcion' => 'nullable|string|max:255',
        ]);

        Marca::findOrFail($id)->update($this->array_marca);

        $this->reset(['array_marca', 'modal_edit']);
        
        session()->flash('message', 'Marca actualizada exitosamente.');
    }

    public function deleteConfirmation($id){
        $this->marca_id = $id;
        $this->array_marca = Marca::findOrFail($id)->toArray();
        $this->modal_delete = true;
    }

    public function delete(){
        Marca::findOrFail($this->marca_id)->delete();

        $this->reset(['array_marca', 'modal_delete']);
        
        session()->flash('message', 'Marca eliminada exitosamente.');
    }

    public function render()
    {
        $marcas = Marca::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nombre', 'asc')
            ->paginate(10);

        return view('livewire.administrador.marcas.index',compact('marcas'));
    }
}
