<?php

namespace App\Livewire\Administrador\Compras;

use App\Models\Compra;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modal_delete = false;

    public $modal_show = false;

    public $array_compra = [
        'id' => null,
        'numero_factura' => '',
        'proveedor_id' => null,
        'fecha_compra' => '',
        'total' => 0.00,
    ];

    public function create()
    {
        return redirect()->route('administrador.compras.create');
    }
    
    public function show($id)
    {
        $compra = Compra::find($id);
        if ($compra) {
            $this->array_compra = $compra;
            //dd($this->array_compra);
            $this->modal_show = true;
        } else {
            session()->flash('error', 'Compra no encontrada.');
        }
    }

    public function deleteConfirmation($id){
        $compra = Compra::find($id);
        if ($compra) {
            $this->array_compra = $compra->toArray();
            $this->modal_delete = true;
        } else {
            session()->flash('error', 'Compra no encontrada.');
        }
    }

    public function delete($id)
    {
        $compra = Compra::find($id);
        if ($compra) {
            $compra->delete();
            session()->flash('message', 'Compra eliminada correctamente.');
        } else {
            session()->flash('error', 'Compra no encontrada.');
        }
        $this->modal_delete = false;
    }

    public function render()
    {
        $compras = Compra::paginate(10);
        return view('livewire.administrador.compras.index',compact('compras'));
    }
}
