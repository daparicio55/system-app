<?php

namespace App\Livewire\Administrador\Proveedores;

use App\Models\Proveedore;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /* public $proveedores; */
    
    public $proveedore_id;

    public $array_proveedore = [
        'ruc' => '',
        'razon_social' => '',
        'nombre_comercial' => '',
        'telefono' => '',
        'email' => '',
        'direccion' => '',
        'contacto' => ''
    ];

    public $search;

    public $modal_create = false;
    public $modal_edit = false;
    public $modal_delete = false;

    public function create(){
        $this->reset(['proveedore_id', 'array_proveedore']);
        $this->modal_create = true;
    }

    public function store(){
        $this->validate([
            'array_proveedore.ruc' => 'required|unique:proveedores,ruc|min:11|max:11',
            'array_proveedore.razon_social' => 'required',
            'array_proveedore.nombre_comercial' => 'nullable|string|max:255',
            'array_proveedore.telefono' => 'nullable|max:11',
            'array_proveedore.email' => 'nullable|email',
            'array_proveedore.direccion' => 'nullable|string|max:255',
            'array_proveedore.contacto' => 'nullable|string|max:255',
        ]);

        Proveedore::create($this->array_proveedore);
        $this->modal_create = false;
        
    }

    public function edit($id){
        $this->proveedore_id = $id;
        $this->array_proveedore = Proveedore::find($id)->toArray();
        $this->modal_edit = true;
    }

    public function update($id){
        $this->validate([
            'array_proveedore.ruc' => 'required|unique:proveedores,ruc,' . $id . '|min:11|max:11',
            'array_proveedore.razon_social' => 'required',
            'array_proveedore.nombre_comercial' => 'nullable|string|max:255',
            'array_proveedore.telefono' => 'nullable|max:11',
            'array_proveedore.email' => 'nullable|email',
            'array_proveedore.direccion' => 'nullable|string|max:255',
            'array_proveedore.contacto' => 'nullable|string|max:255',
        ]);

        Proveedore::find($id)->update($this->array_proveedore);
        $this->modal_edit = false;
    }
    
    public function deleteConfirmation($id){
        $this->proveedore_id = $id;
        $this->array_proveedore = Proveedore::find($id)->toArray();
        $this->modal_delete = true;
    }

    public function delete($id){
        Proveedore::find($id)->delete();
        $this->modal_delete = false;
    }

    public function render()
    {
        $proveedores = Proveedore::query()
        ->when($this->search, function ($query) {
            $query->where('razon_social', 'like', '%' . $this->search . '%')
                  ->orWhere('ruc', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('livewire.administrador.proveedores.index',compact('proveedores'));
    }
}
