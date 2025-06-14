<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Crear Medida
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por Nombre"
            class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>
    {{-- @include('administrador.medidas.create') --}}
    <x-administrador.medidas.create />
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">ID</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Nombre</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Abreviatura</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medidas as $medida)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $medida->id }}</td>
                        <td class="px-3 py-2">{{ $medida->nombre }}</td>
                        <td class="px-3 py-2">{{ $medida->abreviatura }}</td>
                        <td class="flex justify-end pr-2 pt-2 pb-2">
                            <x-button wire:click="edit({{ $medida->id }})" class="me-1">
                                Editar
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $medida->id }})"
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
                        {{ $medidas->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
        @include('administrador.medidas.edit')
        @include('administrador.medidas.delete')
    </div>
</div>
