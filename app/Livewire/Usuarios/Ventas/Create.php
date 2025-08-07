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

    public $array_venta = [
        'id' => 0,
        'cliente_id' => 0,
        'fecha' => '',
        'tipo_comprobante' => '',
        'numero' => '',
        'tipo_pago' => '',
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

    public function store(){
        $this->validate([
            'array_cliente.dni_ruc' => 'required',
            'array_cliente.nombres' => 'required',
            'array_cliente.apellido_paterno' => 'required',
            'array_cliente.apellido_materno' => 'required',
            'array_cliente.direccion' => 'required',
            'array_cliente.telefono' => 'required',
        ]);

        $this->validate([
            'array_venta.tipo_comprobante' => 'required',
            'array_venta.fecha' => 'required|date',
            'array_venta.numero' => 'numeric',
            'array_venta.tipo_pago' => 'required',
        ]);
        dd($this->array_cliente);


    }

    public function render()
    {
        $this->array_venta['fecha'] = now()->format('Y-m-d');
        return view('livewire.usuarios.ventas.create');
    }
}
