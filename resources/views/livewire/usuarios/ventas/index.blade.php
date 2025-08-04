<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <x-button wire:click="create" wire:loading.attr="disabled">
            Registrar Venta
        </x-button>
        <input type="text" wire:model.live="search" placeholder="Buscar por DNI o Nombre del Cliente" class="w-1/2 border border-gray-300 rounded px-3 py-1 text-sm shadow">
    </div>
 
    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">RUC</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Razón Social</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Correo Electrónico</th>
                    <th scope="col" class="text-left pl-2 pt-2 pb-2">Teléfono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
