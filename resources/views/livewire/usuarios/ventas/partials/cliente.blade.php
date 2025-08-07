<div class="grid grid-cols-1 sm:grid-cols-6 gap-4">
    <div class="col-span-6">
        <x-label for="dni_ruc" value="{{ __('DNI/RUC') }}" />
        <x-input class="mt-1 block w-full" wire:model.defer="dni_ruc" />
        <x-input-error for="dni_ruc" class="mt-2" />
        <x-button class="mt-2" wire:click="buscarCliente" wire:loading.attr="disabled">
            Buscar Cliente
        </x-button>
    </div>
    <x-custom.form-input label="Nombre" model="array_cliente.nombre" class="col-span-6 sm:col-span-3" />
    <x-custom.form-input label="Apellido" model="array_cliente.apellido" class="col-span-6 sm:col-span-3" />
    <x-custom.form-input label="Dirección" model="array_cliente.direccion" class="col-span-6 sm:col-span-6" />
    <x-custom.form-input label="Teléfono" model="array_cliente.telefono" class="col-span-6 sm:col-span-3" />
    <x-custom.form-input label="Email" model="array_cliente.email" class="col-span-6 sm:col-span-3" />
</div>
