<x-confirmation-modal wire:model.live="confirmandoBorradoLocal">
    <x-slot name="title">
        {{ __('Eliminar Local') }}
    </x-slot>
    <x-slot name="content">
        ¿Estás seguro de que deseas eliminar el local <b>{{ $locale_nombre }}</b>? Esta acción no se puede deshacer.
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmandoBorradoLocal')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-danger-button class="ms-3" wire:click="delete({{ $locale_id }})">
            {{ __('Eliminar') }}
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
