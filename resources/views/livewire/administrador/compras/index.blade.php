<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Registrar Compra
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por Nombre" class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>

    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">N°</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Proveedor</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Fecha</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">IGV</th>
{{--                     <th scope="col" class="text-left pl-2 pt-2 pb-2">Sub Total</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">IGV</th> --}}
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Total</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Pagado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $compra->numero_factura }}</td>
                        <td class="px-3 py-2">{{ $compra->proveedore->razon_social }}</td>
                        <td class="px-3 py-2">{{ $compra->fecha }}</td>
                        <td class="px-3 py-2">{{ $compra->igv ? 'Sí' : 'No' }}</td>
{{--                         <td class="px-3 py-2">S/ {{ number_format($compra->subtotal, 2) }}</td>
                        <td class="px-3 py-2">S/ {{ number_format($compra->Igvtotal, 2) }}</td> --}}
                        <td class="px-3 py-2">S/ {{ number_format($compra->subtotal + $compra->Igvtotal, 2) }}</td>
                        <td class="px-3 py-2">{{ $compra->pagado ? 'Sí' : 'No' }}</td>
                        <td class="flex justify-end pr-2 pt-2 pb-2">
                            <x-button wire:click="edit({{ $compra->id }})" class="me-1">
                                Editar
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $compra->id }})"
                                class="bg-red-600 hover:bg-red-700">
                                Eliminar
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="px-3 py-2 text-center">
                        {{ $compras->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
        {{-- @include('administrador.marcas.edit')
        @include('administrador.marcas.delete') --}}
    </div>
</div>
