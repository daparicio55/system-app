<?php

namespace App\Livewire\Administrador\Marcas;

use App\Models\Marca;
use Livewire\Component;

class Index extends Component
{
    public $marcas;

    public $marca_id;

    public $array_marca = [
        'nombre' => '',
        'descripcion' => ''
    ];

    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;

    public function mount()
    {
        $this->marcas = Marca::orderBy('id', 'desc')->get();
    }

    public function create(){
        $this->reset(['array_marca', 'modal_create']);
        $this->modal_create = true;
    }

    public function store(){
        $this->validate([
            'array_marca.nombre' => 'required|string|max:255|unique:marcas,nombre',
            'array_marca.descripcion' => 'nullable|string|max:255',
        ]);

        Marca::create($this->array_marca);

        $this->reset(['array_marca', 'modal_create']);
        $this->marcas = Marca::orderBy('id', 'desc')->get();

        session()->flash('message', 'Marca creada exitosamente.');
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
        $this->marcas = Marca::orderBy('id', 'desc')->get();

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
        $this->marcas = Marca::orderBy('id', 'desc')->get();

        session()->flash('message', 'Marca eliminada exitosamente.');
    }

    public function render()
    {
        return view('livewire.administrador.marcas.index');
    }
}
