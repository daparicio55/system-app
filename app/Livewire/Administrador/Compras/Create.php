<?php

namespace App\Livewire\Administrador\Compras;

use App\Models\Catalogo;
use App\Models\Proveedore;
use App\ProveedoreTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Create extends Component
{
    use ProveedoreTrait;

    public $array_proveedore = [];

    public $array_compra = [];

    public $ruc;

    public $producto_seleccionado;

    public $producto_seleccionado_cantidad = 1;

    public $producto_seleccionado_precio = 1;

    //datos para el calculo de los productos que se estan comprando

    public $produtos_comprar = [];

    public $productos_total = 0;

    public $productos_igv = 0;

    public $productos_subtotal = 0;

    public function store() {
        //validar datos
        $this->validate([
            //validar datos del proveedor
            'array_proveedore.ruc' => 'required|digits:11',
            'array_proveedore.razon_social' => 'required|string|max:255',
            'array_proveedore.nombre_comercial' => 'required|string|max:255',
            'array_proveedore.telefono' => 'required|string|max:20',
            'array_proveedore.email' => 'required|email|max:255',
            'array_proveedore.direccion' => 'required|string|max:255',
            'array_proveedore.contacto' => 'required|string|max:255',
            //validar datos de la compra
            'array_compra.numero_factura'=> 'required|string|max:50',
            'array_compra.fecha' => 'required|date',
            'array_compra.igv' => 'nullable|boolean',
            'array_compra.pagado' => 'nullable|boolean',
            //validar productos que se compraran
            'produtos_comprar' => 'required|array',
            'produtos_comprar.*.id' => 'required|exists:catalogos,id',
            'produtos_comprar.*.cantidad' => 'required|numeric|min:1',
            'produtos_comprar.*.precio' => 'required|numeric|min:0.01',
        ]);
        //creamos o actualizamos el proveedor
        $proveedore = Proveedore::updateOrCreate(
            ['ruc' => $this->array_proveedore['ruc']],
            [
                'razon_social' => $this->array_proveedore['razon_social'],
                'nombre_comercial' => $this->array_proveedore['nombre_comercial'],
                'telefono' => $this->array_proveedore['telefono'],
                'email' => $this->array_proveedore['email'],
                'direccion' => $this->array_proveedore['direccion'],
                'contacto' => $this->array_proveedore['contacto'],
            ]
        );

        //creamos la compra
        $compra = $proveedore->compras()->create([
            'numero_factura' => $this->array_compra['numero_factura'],
            'fecha' => $this->array_compra['fecha'],
            'igv' => $this->array_compra['igv'] ?? false,
            'pagado' => $this->array_compra['pagado'] ?? false,
            'user_id' => Auth::id()
        ]);

        //ahora agregamos los productos a la compra
        foreach ($this->produtos_comprar as $item) {
            $compra->catalogos()->attach($item['id'], [
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        return redirect()->route('administrador.compras.index')->with('success', 'Compra registrada exitosamente.');
    }

    public function borrar_producto($index)
    {
        unset($this->produtos_comprar[$index]);
        $this->produtos_comprar = array_values($this->produtos_comprar);
        $this->updateSubTotales();
    }

    public function updateSubTotales(){
        //validamos que los productos a comprar no esten vacios
        $this->validate([
            'produtos_comprar.*.cantidad' => 'required|numeric|min:1',
            'produtos_comprar.*.precio' => 'required|numeric|min:0.01',
        ]);
        foreach ($this->produtos_comprar as $index => $item) {
            $this->produtos_comprar[$index]['subtotal'] = $item['cantidad'] * $item['precio'];
        }
        $this->setSubtotal();
        $this->setIgv();
        $this->setTotal();
    }

    public function setSubtotal(){
        $this->productos_subtotal = 0;
        foreach ($this->produtos_comprar as $index => $item) {
            $this->productos_subtotal += $item['subtotal'];
        }
    }

    public function setIgv(){
        $this->productos_igv = 0;
        if(isset($this->array_compra['igv'])){
            if($this->array_compra['igv']){
                $this->productos_igv = $this->productos_subtotal * 0.18;
            }
        }
    }

    public function setProducto(){
        
    }

    public function setTotal(){
        $this->productos_total = $this->productos_subtotal + $this->productos_igv;
    }

    public function buscarProveedor()
    {
        $this->validate([
            'ruc' => 'required|digits:11',
        ]);

        $proveedore = Proveedore::where('ruc', $this->ruc)->first();

        if (isset($proveedore->id)) {
            $this->array_proveedore = $proveedore->toArray();
        } else {

            $response = $this->getProveedoreByRuc($this->ruc);

            if ($response->failed()) {
                session()->flash('error', 'Error al buscar el proveedor. Intente nuevamente.');
                return;
            }
            $this->array_proveedore = $this->makeArrayFromApi($response->json(), $this->ruc);
        }
    }

    public function cancelar()
    {
        return redirect()->route('administrador.compras.index');
    }

    public function getCatalogoDescripcion($catalogo)
    {
        return $catalogo->codigo . ' - ' . $catalogo->nombre . '- ' . $catalogo->descripcion . ' - ' . $catalogo->marca->nombre . ' - ' . $catalogo->categoria->nombre . ' - X' . $catalogo->medida->nombre;
    }

    public function add_product()
    {
        $this->validate([
            'producto_seleccionado' => 'required|exists:catalogos,id',
            'producto_seleccionado_cantidad' => 'required|numeric|min:1'
        ]);

        $catalogo = Catalogo::find($this->producto_seleccionado);

        //revisamos si el producto ya existe en la lista de productos a comprar
        $index = collect($this->produtos_comprar)->search(function ($item) {
            return $item['id'] == $this->producto_seleccionado;
        });

        if ($index !== false) {
            $this->produtos_comprar[$index]['cantidad'] += $this->producto_seleccionado_cantidad;
            $this->produtos_comprar[$index]['subtotal'] = $this->produtos_comprar[$index]['cantidad'] * $this->produtos_comprar[$index]['precio'];
        } else {
            $this->produtos_comprar[] = [
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

    public function render()
    {

        $catalogos = Catalogo::orderBy('nombre', 'asc')
            ->get()
            ->map(function ($catalogo) {
                return [
                    'id' => $catalogo->id,
                    'nombre' => $this->getCatalogoDescripcion($catalogo),
                ];
            })->toArray();

        return view('livewire.administrador.compras.create', compact('catalogos'));
    }
}
