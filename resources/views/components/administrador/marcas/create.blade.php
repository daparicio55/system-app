@props([
    'model' => 'modal_create_marca',
    'store' => 'store_marca',
])
<div>
    <x-dialog-modal wire:model="{{ $model }}">
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
                    <x-label for="descripcion" value="{{ __('Descripción') }}" />
                    <x-input class="mt-1 block w-full" wire:model.defer="array_marca.descripcion"></x-input>
                    <x-input-error for="array_marca.descripcion" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-modal-buttons model="{{ $model }}" store="{{ $store }}" />
        </x-slot>
    </x-dialog-modal>
</div>
