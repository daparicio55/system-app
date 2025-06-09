<?php

namespace App\Livewire\Administrador\Medidas;

use App\Models\Medida;
use Livewire\Component;

class Index extends Component
{
    public $medidas;

    public $medida_id;

    public $array_medida = [
        'nombre' => '',
        'abreviatura' => ''
    ];

    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;

    public function mount()
    {
        $this->medidas = Medida::orderBy('id', 'desc')
            ->get();
    }    

    public function create(){
        $this->reset(['array_medida', 'modal_create']);
        $this->modal_create = true;
    }

    public function store(){
        $this->validate([
            'array_medida.nombre' => 'required|string|max:255',
            'array_medida.abreviatura' => 'required|string|max:255',
        ]);

        Medida::create($this->array_medida);

        $this->reset(['array_medida', 'modal_create']);
        $this->medidas = Medida::orderBy('id', 'desc')
            ->get();

        session()->flash('message', 'Medida creada exitosamente.');
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
        $this->medidas = Medida::orderBy('id', 'desc')
            ->get();

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
        $this->medidas = Medida::orderBy('id', 'desc')
            ->get();

        session()->flash('message', 'Medida eliminada exitosamente.');
    }

    public function render()
    {
        return view('livewire.administrador.medidas.index');
    }
}
