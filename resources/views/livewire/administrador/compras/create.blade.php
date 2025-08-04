<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-danger-button wire:click="cancelar" wire:loading.attr="disabled">
            Regresar
        </x-danger-button>
    </div>

    <div class="overflow-auto rounded-lg shadow p-4">
        @include('livewire.administrador.compras.partials.proveedor')
    </div>

    <div class="overflow-auto rounded-lg shadow p-4 mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <x-label for="array_compra.numero_factura" value="{{ __('Número de Comprobante') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_compra.numero_factura" />
                <x-input-error for="array_compra.numero_factura" class="mt-2" />
            </div>

            <div>
                <x-label for="array_compra.fecha" value="{{ __('Fecha') }}" />
                <x-input class="mt-1 block w-full" type="date" wire:model.defer="array_compra.fecha" />
                <x-input-error for="array_compra.fecha" class="mt-2" />
            </div>

            <div class="flex flex-col justify-center gap-1">
                <div>
                    <label>
                        <input type="checkbox" wire:model.defer="array_compra.pagado" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring focus:ring-blue-300">
                        <span class="text-gray-700">Comprobante Pagado</span>
                    </label>
                    <x-input-error for="array_compra.pagado" class="mt-2" />
                </div>
                <div>
                    <label>
                        <input type="checkbox" wire:model.defer="array_compra.igv" wire:click="updateSubTotales" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring focus:ring-blue-300">
                        <span class="text-gray-700">Incluir IGV</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-auto rounded-lg shadow p-4 mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <x-live-search-select :items="$catalogos" wireModel="producto_seleccionado" />
                <x-input-error for="producto_seleccionado" class="mt-2" />
            </div>
            <div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <x-label for="cantidad" value="{{ __('Cantidad') }}" />
                        <x-input class="mt-1 block w-full" type="number"
                            wire:model.defer="producto_seleccionado_cantidad" placeholder="Ingrese la cantidad" />
                        <x-input-error for="producto_seleccionado_cantidad" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="precio" value="{{ __('Precio') }}" />
                        <x-input class="mt-1 block w-full" type="number"
                            wire:model.defer="producto_seleccionado_precio" placeholder="Ingrese el precio" />
                        <x-input-error for="producto_seleccionado_precio" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <x-button class="mt-2" wire:click="add_product" wire:loading.attr="disabled">
            Agregar Producto
        </x-button>
    </div>

    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full mt-2">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Cant.</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Descripcion</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">P. Uni.</th>
                    {{-- <th scope="col" class="text-left pl-2 pt-2 pb-2">IGV</th> --}}
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Sub Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos_comprar as $key => $item)
                    <tr class="border-b dark:border-neutral-500" wire:key="row-{{ $item['id'] }}">
                        <td class="px-3 py-2">
                            <input type="number" wire:change="updateSubTotales" wire:model.defer="produtos_comprar.{{ $loop->index }}.cantidad" class="max-w-[100px] border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" min="1" />
                            <x-input-error for="produtos_comprar.{{ $loop->index }}.cantidad" class="mt-2" />
                        </td>
                        <td class="px-3 py-2">{{ $item['descripcion'] }}</td>
                        <td class="px-3 py-2">
                            <input type="number" wire:change="updateSubTotales" wire:model.defer="produtos_comprar.{{ $loop->index }}.precio" class="max-w-[130px] border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" min="0" step="0.01" />
                            <x-input-error for="produtos_comprar.{{ $loop->index }}.precio" class="mt-2" />
                        </td>
                        <td class="py-2 text-right min-w-[140px]">S/ {{ number_format($item['subtotal'],2) }}</td>
                        <td class="px-3 py-2">
                            <x-danger-button wire:click="borrar_producto({{ $key }})" title="Eliminar Producto">
                                <i class="fa-solid fa-trash-can"></i>
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="font-extrabold text-right pr-2">SUBTOTAL</td>
                    <td class="font-extrabold text-right">S/ {{ number_format($productos_subtotal,2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="font-extrabold text-right pr-2">IGV</td>
                    <td class="font-extrabold text-right">S/ {{ number_format($productos_igv,2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="font-extrabold text-right pr-2">TOTAL</td>
                    <td class="font-extrabold text-right">S/ {{ number_format($productos_total,2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <x-input-error for="produtos_comprar" class="mt-2" />

    <div class="flex justify-between items-center mb-4 mt-4">
        <x-button wire:click="store" wire:loading.attr="disabled">
            <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Compra
        </x-button>
    </div>
</div>
