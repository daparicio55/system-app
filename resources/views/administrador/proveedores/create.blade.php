<x-dialog-modal wire:model="modal_create">
    <x-slot name="title">
        {{ __('Crear Proveedor') }}
    </x-slot>
    <x-slot name="content">
        <div class="space-y-4">
            <div>
                <x-label for="nombre" value="{{ __('RUC') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.ruc" />
                <x-input-error for="array_proveedore.ruc" class="mt-2" />
            </div>

            <div>
                <x-label for="array_proveedore.razon_social" value="{{ __('Razón Social') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.razon_social"/>
                <x-input-error for="array_proveedore.razon_social" class="mt-2" />
            </div>

            <div>
                <x-label for="array_proveedore.nombre_comercial" value="{{ __('Nombre Comercial') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.nombre_comercial"/>
                <x-input-error for="array_proveedore.nombre_comercial" class="mt-2" />
            </div>

            <div>
                <x-label for="array_proveedore.direccion" value="{{ __('Dirección') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.direccion"/>
                <x-input-error for="array_proveedore.direccion" class="mt-2" />
            </div>

            <div>
                <x-label for="array_proveedore.contacto" value="{{ __('Contacto') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.contacto"/>
                <x-input-error for="array_proveedore.contacto" class="mt-2" />
            </div>

            <div>
                <x-label for="array_proveedore.telefono" value="{{ __('Telefono') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.telefono"/>
                <x-input-error for="array_proveedore.telefono" class="mt-2" />
            </div>
            
            <div>
                <x-label for="array_proveedore.email" value="{{ __('Correo Electrónico') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_proveedore.email"/>
                <x-input-error for="array_proveedore.email" class="mt-2" />
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