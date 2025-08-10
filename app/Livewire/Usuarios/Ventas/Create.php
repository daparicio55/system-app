<?php

namespace App\Livewire\Usuarios\Ventas;

use App\CatalogoTrait;
use App\ClienteTrait;
use App\Models\Catalogo;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Create extends Component
{
    use ClienteTrait;
    use CatalogoTrait;

    public $dni_ruc;

    public $array_cliente = [
        'id' => 0,
        'dni_ruc' => '',
        'nombres' => '',
        'apellido_paterno' => '',
        'apellido_materno' => '',
        'direccion' => '',
        'telefono' => '',
        'email' => ''
    ];

    public $array_venta = [
        'id' => 0,
        'cliente_id' => 0,
        'fecha' => '',
        'tipo_comprobante' => 'Ticket',
        'numero' => '',
        'tipo_pago' => 'Efectivo',
    ];

    public $productos_vender = [];

    public $productos_total = 0;

    public $productos_igv = 0;

    public $productos_subtotal = 0;

    public $producto_seleccionado;

    public $producto_seleccionado_cantidad = 1;

    public $producto_seleccionado_precio = 1;


    public function setProducto($id)
    {
        $catalogo = Catalogo::find($id);
        $this->producto_seleccionado_precio = $catalogo->precio;
    }

    public function add_product()
    {
        $this->validate([
            'producto_seleccionado' => 'required|exists:catalogos,id',
            'producto_seleccionado_cantidad' => 'required|numeric|min:1'
        ]);

        $catalogo = Catalogo::find($this->producto_seleccionado);

        //revisamos si el producto ya existe en la lista de productos a comprar
        $index = collect($this->productos_vender)->search(function ($item) {
            return $item['id'] == $this->producto_seleccionado;
        });

        if ($index !== false) {
            $this->productos_vender[$index]['cantidad'] += $this->producto_seleccionado_cantidad;
            $this->productos_vender[$index]['subtotal'] = $this->productos_vender[$index]['cantidad'] * $this->productos_vender[$index]['precio'];
        } else {
            $this->productos_vender[] = [
                'id' => $catalogo->id,
                'cantidad' => $this->producto_seleccionado_cantidad,
                'descripcion' => $this->getCatalogoDescripcion($catalogo),
                'precio' => $this->producto_seleccionado_precio,
                'subtotal' => $this->producto_seleccionado_precio * $this->producto_seleccionado_cantidad,
            ];
        }

        $this->setSubtotal();

        $this->setIgv();

        $this->setTotal();

        //limpiar
        $this->producto_seleccionado_cantidad = 1;
    }


    public function updateSubTotales()
    {
        //validamos que los productos a comprar no esten vacios
        $this->validate([
            'productos_vender.*.cantidad' => 'required|numeric|min:1',
            'productos_vender.*.precio' => 'required|numeric|min:0.01',
        ]);
        foreach ($this->productos_vender as $index => $item) {
            $this->productos_vender[$index]['subtotal'] = $item['cantidad'] * $item['precio'];
        }
        $this->setSubtotal();
        $this->setIgv();
        $this->setTotal();
    }

    public function setSubtotal()
    {
        $this->productos_subtotal = 0;
        foreach ($this->productos_vender as $index => $item) {
            $this->productos_subtotal += $item['subtotal'];
        }
    }

    public function setIgv()
    {
        $this->productos_igv = 0;
        if (isset($this->array_compra['igv'])) {
            if ($this->array_compra['igv']) {
                $this->productos_igv = $this->productos_subtotal * 0.18;
            }
        }
    }

    public function setTotal()
    {
        $this->productos_total = $this->productos_subtotal + $this->productos_igv;
    }



    public function buscar_cliente()
    {
        $this->validate([
            'dni_ruc' => ['required', 'regex:/^(\d{8}|\d{11})$/'],
        ]);
        $cliente = Cliente::where('dni_ruc', $this->dni_ruc)->first();
        if (isset($cliente->id)) {
            $this->array_cliente = [
                'id' => $cliente->id,
                'dni_ruc' => $cliente->dni_ruc,
                'nombres' => $cliente->nombres,
                'apellido_paterno' => $cliente->apellido_paterno,
                'apellido_materno' => $cliente->apellido_materno,
                'direccion' => $cliente->direccion,
                'telefono' => $cliente->telefono,
                'email' => $cliente->email
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

    public function store()
    {
        $this->validate([
            'array_cliente.dni_ruc' => 'required',
            'array_cliente.nombres' => 'required',
            'array_cliente.apellido_paterno' => 'required',
            'array_cliente.apellido_materno' => 'required',
            'array_cliente.direccion' => 'required',
            'array_cliente.telefono' => 'required',

            'array_venta.tipo_comprobante' => 'required',
            'array_venta.fecha' => 'required|date',
            'array_venta.numero' => 'numeric',
            'array_venta.tipo_pago' => 'required',

            'productos_vender' => 'required|array',
            'productos_vender.*.id' => 'required|exists:catalogos,id',
            'productos_vender.*.cantidad' => 'required|numeric|min:1',
            'productos_vender.*.precio' => 'required|numeric|min:0.01',

        ]);

        //creamos o actualizamos el cliente
        $cliente = Cliente::updateOrCreate(
            ['dni_ruc' => $this->array_cliente['dni_ruc']],
            [
                'nombres' => $this->array_cliente['nombres'],
                'apellido_paterno' => $this->array_cliente['apellido_paterno'],
                'apellido_materno' => $this->array_cliente['apellido_materno'],
                'direccion' => $this->array_cliente['direccion'],
                'telefono' => $this->array_cliente['telefono'],
                'email' => $this->array_cliente['email'],
            ]
        );

        //obtener numero de venta si es que esta vacio
        if(isset($this->array_venta['numero'])) {
            //obtenemos el ultimo numero dependiendo el tipo de comprobante
            $ultimo_numero = $cliente->ventas()->where('tipo_comprobante', $this->array_venta['tipo_comprobante'])->max('numero');
            $this->array_venta['numero'] = $ultimo_numero ? $ultimo_numero + 1 : 1;
        }

        //agregramos la venta
        $venta = $cliente->ventas()->create([
            'user_id' => Auth::id(),
            'fecha' => $this->array_venta['fecha'],
            'tipo_comprobante' => $this->array_venta['tipo_comprobante'],
            'numero' => $this->array_venta['numero'],
            'tipo_pago' => $this->array_venta['tipo_pago']
        ]);

         //ahora agregamos los productos a la venta
        foreach ($this->productos_vender as $item) {
            $venta->catalogos()->attach($item['id'], [
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        return redirect()->route('usuarios.ventas.index')->with('success', 'Venta registrada exitosamente.');
    }

    public function render()
    {
        $this->array_venta['fecha'] = now()->format('Y-m-d');
        $catalogos = Catalogo::orderBy('nombre', 'asc')
            ->get()
            ->map(function ($catalogo) {
                return [
                    'id' => $catalogo->id,
                    'nombre' => $this->getCatalogoDescripcion($catalogo),
                    'precio' => $catalogo->precio,
                ];
            })->toArray();
        return view('livewire.usuarios.ventas.create', compact('catalogos'));
    }
}
