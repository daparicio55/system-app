<x-dialog-modal wire:model.live="editandoLocal">
    <x-slot name="title">
        {{ __('Editar Local') }}
    </x-slot>
    <x-slot name="content">
        {{-- campos para editar;  --}}
        <div class="mb-4">
            <x-label for="codigo" value="{{ __('Código') }}" />
            <x-input id="codigo" type="text" class="mt-1 block w-full" wire:model.defer="edit_local.codigo" />
            <x-input-error for="edit_local.codigo" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="nombre" value="{{ __('Nombre') }}" />
            <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model.defer="edit_local.nombre" />
            <x-input-error for="edit_local.nombre" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="direccion" value="{{ __('Dirección') }}" />
            <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model.defer="edit_local.direccion" />
            <x-input-error for="edit_local.direccion" class="mt-2" />
        </div>
        <div class="mb-4">
            <x-label for="telefono" value="{{ __('Teléfono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model.defer="edit_local.telefono" />
            <x-input-error for="edit_local.telefono" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('editandoLocal')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-button class="ms-3" wire:click="actualizar({{ $locale_id }})" wire:loading.attr="disabled">
            {{ __('Actualizar') }}
        </x-button>
    </x-slot>
</x-dialog-modal>
