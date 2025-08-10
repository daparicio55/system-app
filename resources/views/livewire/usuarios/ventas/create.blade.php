<div class="p-6">
    <form wire:submit.prevent="store">
        <div class="flex justify-between items-center mb-4">
            <x-danger-button wire:click="cancelar" wire:loading.attr="disabled">
                Regresar
            </x-danger-button>
        </div>

        <div class="overflow-auto rounded-lg shadow p-4">
            @include('livewire.usuarios.ventas.partials.cliente')
        </div>

        <div class="overflow-auto rounded-lg shadow p-4 mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">

                <x-custom.form-input label="Fecha" model="array_venta.fecha" class="col-span-1 sm:col-span-3"
                    type="date" />

                {{-- tipo de comprobante --}}
                <div class="col-span-1 sm:col-span-3">
                    <x-label for="array_venta.tipo_comprobante" value="Tipo" />
                    <x-select wire:model.defer="array_venta.tipo_comprobante">
                        <option value="Ticket">Ticket</option>
                        <option value="Boleta">Boleta</option>
                        <option value="Factura">Factura</option>
                    </x-select>
                    <x-input-error for="array_venta.tipo_comprobante" class="mt-2" />
                </div>

                <x-custom.form-input label="Número" model="array_venta.numero" class="col-span-1 sm:col-span-3" />

                {{-- tipo de pago --}}

                <div class="col-span-1 sm:col-span-3">
                    <x-label for="array_venta.tipo_pago" value="Tipo de Pago" />
                    <x-select wire:model.defer="array_venta.tipo_pago">
                        <option value="Efectivo">Efectivo</option>
                        <option value="Yape">Yape</option>
                        <option value="Plin">Plin</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                    </x-select>
                    <x-input-error for="array_venta.tipo_pago" class="mt-2" />
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
            <x-button type="button" class="mt-2" wire:click="add_product" wire:loading.attr="disabled">
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
                    @foreach ($productos_vender as $key => $item)
                        <tr class="border-b dark:border-neutral-500" wire:key="row-{{ $item['id'] }}">
                            <td class="px-3 py-2">
                                <input type="number" wire:change="updateSubTotales"
                                    wire:model.defer="productos_vender.{{ $loop->index }}.cantidad"
                                    class="max-w-[100px] border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                                    min="1" />
                                <x-input-error for="productos_vender.{{ $loop->index }}.cantidad" class="mt-2" />
                            </td>
                            <td class="px-3 py-2">{{ $item['descripcion'] }}</td>
                            <td class="px-3 py-2">
                                <input type="number" wire:change="updateSubTotales"
                                    wire:model.defer="productos_vender.{{ $loop->index }}.precio"
                                    class="max-w-[130px] border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                                    min="0" step="0.01" />
                                <x-input-error for="productos_vender.{{ $loop->index }}.precio" class="mt-2" />
                            </td>
                            <td class="py-2 text-right min-w-[140px]">S/ {{ number_format($item['subtotal'], 2) }}</td>
                            <td class="px-3 py-2">
                                <x-danger-button wire:click="borrar_producto({{ $key }})"
                                    title="Eliminar Producto">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="font-extrabold text-right pr-2">SUBTOTAL</td>
                        <td class="font-extrabold text-right">S/ {{ number_format($productos_subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-extrabold text-right pr-2">IGV</td>
                        <td class="font-extrabold text-right">S/ {{ number_format($productos_igv, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-extrabold text-right pr-2">TOTAL</td>
                        <td class="font-extrabold text-right">S/ {{ number_format($productos_total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <x-input-error for="productos_vender" class="mt-2" />

        {{-- mostrar todos los errores de validacion --}}
        {{-- Resumen global de TODOS los errores --}}
        @if ($errors->any()) {{-- si hay cualquier error --}}
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-3 text-red-800"> {{-- caja de alerta --}}
                <p class="font-semibold">Corrige los siguientes errores:</p> {{-- título --}}
                <ul class="list-disc pl-5"> {{-- lista --}}
                    @foreach ($errors->all() as $error)
                        {{-- recorre todos los mensajes --}}
                        <li>{{ $error }}</li> {{-- cada mensaje --}}
                    @endforeach {{-- fin foreach --}}
                </ul> {{-- fin lista --}}
            </div> {{-- fin alerta --}}
        @endif {{-- fin if --}}


        <div class="flex justify-between items-center mb-4 mt-4">
            <x-button>
                <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Venta
            </x-button>
        </div>
    </form>
</div>
