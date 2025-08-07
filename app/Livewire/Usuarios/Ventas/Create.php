<?php

namespace App\Livewire\Usuarios\Ventas;

use App\ClienteTrait;
use App\Models\Cliente;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Create extends Component
{
    use ClienteTrait;
    public $dni_ruc;

    public $array_cliente = [
        'id' => 0,
        'dni_ruc' => '',
        'nombres' => '',
        'apellido_paterno' => '',
        'apellido_materno' => '',
        'direccion' => '',
        'telefono' => '',
    ];

    public function buscar_cliente()
    {
        $this->validate([
            'dni_ruc' => ['required', 'regex:/^(\d{8}|\d{11})$/'],
        ]);
        $cliente = Cliente::where('dni_ruc', $this->dni_ruc)->first();
        if (isset($cliente->id)) {
            $this->array_cliente = [
                'id' => $cliente->id,
                'dni_ruc' => $cliente->dni,
                'nombres' => $cliente->nombres,
                'apellido_paterno' => $cliente->apellido_paterno,
                'apellido_materno' => $cliente->apellido_materno,
                'direccion' => $cliente->direccion,
                'telefono' => $cliente->telefono,
            ];
        } else {
            $response = $this->getClienteByDni($this->dni_ruc);
            if ($response->failed()) {
                session()->flash('error', 'Error al buscar el proveedor. Intente nuevamente.');
                return;
            }
            $this->array_cliente = $this->makeArrayFromApi($response->json(), $this->dni_ruc);
        }
    }

    public function cancelar()
    {
        return Redirect::route('usuarios.ventas.index');
    }

    public function render()
    {
        return view('livewire.usuarios.ventas.create');
    }
}
