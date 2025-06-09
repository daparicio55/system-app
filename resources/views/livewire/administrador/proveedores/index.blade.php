<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Crear Proveedor
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por RUC o Razón Social" class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>
    {{-- <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Crear Proveedor
        </x-button>

        <input type="text" wire:model.live="search" placeholder="Buscar por RUC o Razón Social"
            class="w-full sm:w-96 border border-gray-300 rounded px-4 py-2 text-sm shadow focus:outline-none focus:ring focus:border-blue-300">
    </div> --}}
    @include('administrador.proveedores.create')
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">RUC</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Razón Social</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Correo Electrónico</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Teléfono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedore)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $proveedore->ruc }}</td>
                        <td class="px-3 py-2">{{ $proveedore->razon_social }}</td>
                        <td class="px-3 py-2">{{ $proveedore->email }}</td>
                        <td class="px-3 py-2">{{ $proveedore->telefono }}</td>
                        <td class="flex justify-end pr-2 pt-2 pb-2">
                            <x-button wire:click="edit({{ $proveedore->id }})" class="me-1">
                                Editar
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $proveedore->id }})"
                                class="bg-red-600 hover:bg-red-700">
                                Eliminar
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="px-3 py-2 text-center">
                        {{ $proveedores->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
        @include('administrador.proveedores.edit')
        @include('administrador.proveedores.delete')
    </div>
</div>
