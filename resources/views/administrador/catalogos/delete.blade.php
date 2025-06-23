<x-confirmation-modal wire:model.live="modal_delete">
    <x-slot name="title">
        {{ __('Eliminar Catálogo') }}
    </x-slot>
    <x-slot name="content">
        ¿Estás seguro de que deseas eliminar este catálogo? Esta acción no se puede deshacer.
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('modal_delete')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-danger-button class="ms-3" wire:click="delete({{ $catalogo_id }})">
            {{ __('Eliminar') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>