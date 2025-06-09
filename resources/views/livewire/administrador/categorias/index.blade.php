<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Crear Categoría
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por Nombre" class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>
    @include('administrador.categorias.create')
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Nombre</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Descripción</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Cat. Padre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $categoria->nombre }}</td>
                        <td class="px-3 py-2">{{ $categoria->descripcion }}</td>
                        <td class="px-3 py-2">
                            {{ $categoria->parentCategoria ? $categoria->parentCategoria->nombre : '' }}
                        </td>
                        <td class="flex justify-end pr-2 pt-2 pb-2">
                            <x-button wire:click="edit({{ $categoria->id }})" class="me-1">
                                Editar
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $categoria->id }})"
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
                        {{ $categorias->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
        @include('administrador.categorias.edit')
        @include('administrador.categorias.delete')
    </div>
</div>