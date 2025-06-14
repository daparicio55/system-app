<x-dialog-modal wire:model="modal_create">
    <x-slot name="title">
        {{ __('Crear Catálogo') }}
    </x-slot>
    <x-slot name="content">
        <div class="space-y-4">
            <div>
                <x-label for="nombre" value="{{ __('Nombre') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_catalogo.nombre" />
                <x-input-error for="array_catalogo.nombre" class="mt-2" />
            </div>

            <div>
                <x-label for="descripcion" value="{{ __('Descripción') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_catalogo.descripcion"></x-input>
                <x-input-error for="array_catalogo.descripcion" class="mt-2" />
            </div>
            <div>
                <x-label for="categoria_id" value="{{ __('Categoría') }}" />
                <x-select wire:model.defer="array_catalogo.categoria_id">
                    <option value="">-- Seleccione Categoría --</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                    @endforeach
                </x-select>
                <x-button class="mt-2" wire:click="modalCreateCategoria">
                    {{ __('Crear Nueva Categoría') }}
                </x-button>
                <x-input-error for="array_catalogo.categoria_id" class="mt-2" />
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