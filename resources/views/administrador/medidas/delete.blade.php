<x-confirmation-modal wire:model.live="modal_delete">
    <x-slot name="title">
        {{ __('Eliminar Local') }}
    </x-slot>
    <x-slot name="content">
        ¿Estás seguro de que deseas eliminar la medida <b>{{ $array_medida['nombre'] }}</b>? Esta acción no se puede deshacer.
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('modal_delete')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-danger-button class="ms-3" wire:click="delete({{ $medida_id }})">
            {{ __('Eliminar') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
