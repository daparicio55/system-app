<?php

namespace App\Livewire\Usuarios\Ventas;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Index extends Component
{
    public $modal_create = false;

    public function create(){
        return Redirect::route('usuarios.ventas.create');
    }
    public function render()
    {
        return view('livewire.usuarios.ventas.index');
    }
}
