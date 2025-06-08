<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="crearLocal" wire:loading.attr="disabled">
            Crear Local
        </x-button>
    </div>

    <x-dialog-modal wire:model.live="creandoLocal">
    <x-slot name="title">
        {{ __('Crear Local') }}
    </x-slot>
    <x-slot name="content">
        {{-- campos para crear;  --}}
        <div class="mb-4">
            <x-label for="codigo" value="{{ __('Código') }}" />
            <x-input id="codigo" type="text" class="mt-1 block w-full" wire:model.defer="array_local.codigo" />
            <x-input-error for="crear_local.codigo" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="nombre" value="{{ __('Nombre') }}" />
            <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model.defer="array_local.nombre" />
            <x-input-error for="crear_local.nombre" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="direccion" value="{{ __('Dirección') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model.defer="array_local.direccion" />
            <x-input-error for="crear_local.direccion" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="telefono" value="{{ __('Teléfono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model.defer="array_local.telefono" />
            <x-input-error for="crear_local.telefono" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('creandoLocal')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-button class="ms-3" wire:click="guardar" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-dialog-modal>




    <div class="overflow-hidden rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">ID</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Código</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Nombre</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Dirección</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Teléfono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locales as $locale)
                    <tr class="border-b dark:border-neutral-500">
                        <td class="pl-2 font-medium pt-1 pb-1">
                            {{ $locale->id }}
                        </td>
                        <td class="pl-2 font-medium pt-1 pb-1">
                            {{ $locale->codigo }}
                        </td>
                        <td class="pl-2 font-medium pt-1 pb-1">
                            {{ $locale->nombre }}
                        </td>
                        <td class="pl-2 font-medium pt-1 pb-1">
                            {{ $locale->direccion }}
                        </td>
                        <td class="pl-2 font-medium pt-1 pb-1">
                            {{ $locale->telefono }}
                        </td>
                        <td class="pl-2 pt-1 pb-1">
                            <x-button wire:click="editarLocal({{ $locale->id }})" wire:loading.attr="disabled">
                                Editar
                            </x-button>
                            <x-danger-button class="mt-2 md:mt-0" wire:click="confirmarBorrado({{ $locale->id }})"
                                wire:loading.attr="disabled">
                                Eliminar
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('livewire.locales.modal-delete')
    @include('livewire.locales.modal-edit')
</div>
