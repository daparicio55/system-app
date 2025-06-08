<?php

namespace App\Livewire\Locales;

use App\Models\Locale;
use Livewire\Component;

class ListLocale extends Component
{
    public $locales;
    
    public $locale_id;
    public $locale_nombre;

    public $edit_local = [
        'id',
        'codigo',
        'nombre',
        'direccion',
        'telefono'
    ];

    public $array_local = [
        'codigo' => '',
        'nombre' => '',
        'direccion' => '',
        'telefono' => ''
    ];

    public $confirmandoBorradoLocal = false;
    public $editandoLocal = false;
    public $creandoLocal = false;

    public function mount()
    {
        $this->locales = Locale::all();
    }

    public function confirmarBorrado($id){
        
        $this->resetErrorBag();
        $locale = Locale::find($id);
        
        $this->locale_id = $id;
        $this->locale_nombre = $locale ? $locale->nombre : '';

        $this->confirmandoBorradoLocal = true;
    }

    public function delete(){
        $locale = Locale::find($this->locale_id);
        if ($locale) {
            $locale->delete();
            $this->locales = Locale::all();
            $this->confirmandoBorradoLocal = false;
            session()->flash('message', 'Locale deleted successfully.');
        } else {
            session()->flash('error', 'Locale not found.');
        }
    }


    public function editarLocal($id){
        $this->resetErrorBag();
        $locale = Locale::find($id);
        if ($locale) {
            $this->locale_id = $locale->id;
            $this->edit_local = [
                'id' => $locale->id,
                'codigo' => $locale->codigo,
                'nombre' => $locale->nombre,
                'direccion' => $locale->direccion,
                'telefono' => $locale->telefono
            ];
        } else {
            session()->flash('error', 'Locale not found.');
        }

        $this->editandoLocal = true;
    }

    public function actualizar($id){
        $this->validate([
            'edit_local.codigo' => 'required|string|max:255',
            'edit_local.nombre' => 'required|string|max:255',
            'edit_local.direccion' => 'nullable|string|max:255',
            'edit_local.telefono' => 'nullable|string|max:20',
        ]);

        $locale = Locale::find($id);
        if ($locale) {
            $locale->update($this->edit_local);
            $this->locales = Locale::all();
            $this->editandoLocal = false;
            session()->flash('message', 'Locale updated successfully.');
        } else {
            session()->flash('error', 'Locale not found.');
        }
    }

    public function crearLocal(){
        $this->resetErrorBag();
        $this->array_local = [
            'codigo' => '',
            'nombre' => '',
            'direccion' => '',
            'telefono' => ''
        ];
        $this->creandoLocal = true;
    }
    
    public function render()
    {
        return view('livewire.locales.list-locale');
    }
}
