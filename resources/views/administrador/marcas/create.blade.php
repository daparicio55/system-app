<x-dialog-modal wire:model="modal_create">
    <x-slot name="title">
        {{ __('Crear Marca') }}
    </x-slot>
    <x-slot name="content">
        <div class="space-y-4">
            <div>
                <x-label for="nombre" value="{{ __('Nombre') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_marca.nombre" />
                <x-input-error for="array_marca.nombre" class="mt-2" />
            </div>
            <div>
                <x-label for="array_marca.descripcion" value="{{ __('Descripcion') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_marca.descripcion"/>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('modal_create')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-button class="ms-3" wire:click="store" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-dialog-modal>