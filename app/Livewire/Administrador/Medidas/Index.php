<?php

namespace App\Livewire\Administrador\Medidas;

use App\MedidaTrait;
use App\Models\Medida;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use MedidaTrait;
    use WithPagination;

    public $medida_id;

    public $search;

    public $modal_edit = false;
    public $modal_delete = false;
  

    public function create(){
        $this->reset(['array_medida']);
        $this->modal_create_medida = true;
    }

    public function edit($id){
        $this->medida_id = $id;
        $this->array_medida = Medida::findOrFail($id)->toArray();
        $this->modal_edit = true;
    }

    public function update(){
        $this->validate([
            'array_medida.nombre' => 'required|string|max:255',
            'array_medida.abreviatura' => 'required|string|max:255|unique:medidas,abreviatura,' . $this->medida_id,
        ]);

        $medida = Medida::findOrFail($this->medida_id);
        $medida->update($this->array_medida);

        $this->reset(['array_medida', 'modal_edit']);

        session()->flash('message', 'Medida actualizada exitosamente.');
    }

    public function deleteConfirmation($id)
    {
        $this->medida_id = $id;
        $this->array_medida = Medida::findOrFail($id)->toArray();
        $this->modal_delete = true;
    }

    public function delete()
    {
        $medida = Medida::findOrFail($this->medida_id);
        $medida->delete();

        $this->reset(['array_medida', 'modal_delete']);

        session()->flash('message', 'Medida eliminada exitosamente.');
    }

    public function render()
    {
        $medidas = Medida::query()
            ->when($this->search,function($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('abreviatura', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nombre', 'asc')
            ->paginate(10);
        return view('livewire.administrador.medidas.index', compact('medidas'));
    }
}
