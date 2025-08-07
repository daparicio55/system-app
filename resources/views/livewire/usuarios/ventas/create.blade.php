<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-danger-button wire:click="cancelar" wire:loading.attr="disabled">
            Regresar
        </x-danger-button>
    </div>

    <div class="overflow-auto rounded-lg shadow p-4">
        @include('livewire.usuarios.ventas.partials.cliente')
    </div>
    
</div>
