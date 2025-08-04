<?php

namespace App\Livewire\Usuarios\Ventas;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Create extends Component
{

    public function cancelar(){
        return Redirect::route('usuarios.ventas.index');
    }

    public function render()
    {
        return view('livewire.usuarios.ventas.create');
    }
}
