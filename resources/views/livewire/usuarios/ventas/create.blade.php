<div class="p-6">
    <form wire:submit.prevent="store">
        <div class="flex justify-between items-center mb-4">
            <x-danger-button wire:click="cancelar" wire:loading.attr="disabled">
                Regresar
            </x-danger-button>
        </div>

        <div class="overflow-auto rounded-lg shadow p-4">
            @include('livewire.usuarios.ventas.partials.cliente')
        </div>

        <div class="overflow-auto rounded-lg shadow p-4 mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">

                <x-custom.form-input label="Fecha" model="array_venta.fecha" class="col-span-1 sm:col-span-3"
                    type="date" />

                {{-- tipo de comprobante --}}
                <div class="col-span-1 sm:col-span-3">
                    <x-label for="tipo_comprobante" value="Tipo" />
                    <x-select wire:model.defer="array_venta.tipo_comprobante">
                        <option value="Ticket">Ticket</option>
                        <option value="Boleta">Boleta</option>
                        <option value="Factura">Factura</option>
                    </x-select>
                    <x-input-error for="array_venta.tipo_comprobante" class="mt-2" />
                </div>

                <x-custom.form-input label="Número" model="array_venta.numero" class="col-span-1 sm:col-span-3" />

                {{-- tipo de pago --}}

                <div class="col-span-1 sm:col-span-3">
                    <x-label for="tipo_pago" value="Tipo de Pago" />
                    <x-select wire:model.defer="array_cliente.tipo_pago">
                        <option value="Efectivo">Efectivo</option>
                        <option value="Yape">Yape</option>
                        <option value="Plin">Plin</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                    </x-select>
                    <x-input-error for="array_cliente.tipo_pago" class="mt-2" />
                </div>

            </div>
        </div>
        <div class="flex justify-between items-center mb-4 mt-4">
            <x-button>
                <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar Venta
            </x-button>
        </div>
    </form>
</div>
