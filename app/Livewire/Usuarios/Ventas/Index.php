<?php

namespace App\Livewire\Usuarios\Ventas;

use App\Models\Venta;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Index extends Component
{
    public $modal_create = false;

    public $modal_show = false;

    public $modal_delete = false;

    public $array_venta = [
        'id' => null,
        'numero' => "",
        'fecha' => null,
        'cliente' => null,
        'total' => null,
        'tipo_comprobante' => null
    ];

    public function show($id){
        $this->array_venta = Venta::find($id);
        $this->modal_show = true;
    }

    public function deleteConfirmation($id){
        $venta = Venta::find($id);
        if ($venta) {
            $this->array_venta = $venta->toArray();
            $this->modal_delete = true;
        } else {
            session()->flash('error', 'Venta no encontrada.');
        }
    }

    public function delete($id)
    {
        $venta = Venta::find($id);
        if ($venta) {
            $venta->delete();
            session()->flash('message', 'Venta eliminada correctamente.');
        } else {
            session()->flash('error', 'Venta no encontrada.');
        }
        $this->modal_delete = false;
    }

    public function create(){
        return Redirect::route('usuarios.ventas.create');
    }
    public function render()
    {
        $ventas = Venta::paginate(10);
        return view('livewire.usuarios.ventas.index', compact('ventas'));
    }
}
