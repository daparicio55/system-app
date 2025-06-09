<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Crear Marca
        </x-button>
    </div>
    @include('administrador.marcas.create')
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">ID</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Nombre</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Descripción</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="px-3 py-2">{{ $marca->id }}</td>
                        <td class="px-3 py-2">{{ $marca->nombre }}</td>
                        <td class="px-3 py-2">{{ $marca->descripcion }}</td>
                        <td class="flex justify-end pr-2 pt-2 pb-2">
                            <x-button wire:click="edit({{ $marca->id }})" class="me-1">
                                Editar
                            </x-button>
                            <x-button wire:click="deleteConfirmation({{ $marca->id }})" class="bg-red-600 hover:bg-red-700">
                                Eliminar
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('administrador.marcas.edit')
        @include('administrador.marcas.delete')
    </div>
</div>