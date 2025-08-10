<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Registrar Venta
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por DNI o Nombre del Cliente" class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>
 
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Fecha</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Comprobante</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Número</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Cliente</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $venta->fecha }}</td>
                        <td class="px-3 py-2">{{ $venta->tipo_comprobante }}</td>
                        <td class="px-3 py-2">{{ Str::padLeft($venta->numero, 4, '0') }}</td>
                        <td class="px-3 py-2">{{ $venta->cliente->nombres }} {{ $venta->cliente->apellido_paterno }} {{ $venta->cliente->apellido_materno }}</td>
                        <td class="px-3 py-2">S/ {{ number_format($venta->total,2) }}</td>
                        <td class="px-3 py-2">
                            <x-button class="me-1" wire:click="show({{ $venta->id }})">
                                Ver
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $venta->id }})"
                                class="bg-red-600 hover:bg-red-700">
                                Eliminar
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('livewire.usuarios.ventas.show')
        @include('livewire.usuarios.ventas.delete')
    </div>
</div>
