<?php

namespace App\Livewire\Administrador\Compras;

use App\Models\Compra;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function create()
    {
        return redirect()->route('administrador.compras.create');
    }
    
    public function render()
    {
        $compras = Compra::paginate(10);
        return view('livewire.administrador.compras.index',compact('compras'));
    }
}
