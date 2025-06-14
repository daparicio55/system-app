@props([
    'model' => 'modal_create',
    'store' => 'store',
    'parent_categories'=> []
])
<div>
    <x-dialog-modal wire:model="{{ $model }}">
        <x-slot name="title">
            {{ __('Crear Categoría') }}
        </x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <div>
                    <x-label for="nombre" value="{{ __('Nombre') }}" />
                    <x-input class="mt-1 block w-full" wire:model.defer="array_categoria.nombre" />
                    <x-input-error for="array_categoria.nombre" class="mt-2" />
                </div>

                <div>
                    <x-label for="descripcion" value="{{ __('Descripción') }}" />
                    <x-input class="mt-1 block w-full" wire:model.defer="array_categoria.descripcion"></x-input>
                    <x-input-error for="array_categoria.descripcion" class="mt-2" />
                </div>
                <div>
                    <x-label for="categoria_id" value="{{ __('Categoría Padre') }}" />
                    <x-select wire:model.defer="array_categoria.categoria_id">
                        <option value="">-- Sin categoria Padre --</option>
                        @foreach ($parent_categories as $parent_categorie)
                            <option value="{{ $parent_categorie['id'] }}">{{ $parent_categorie['nombre'] }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="array_categoria.categoria_id" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-modal-buttons model="{{ $model }}" store="{{ $store }}" />
        </x-slot>
    </x-dialog-modal>
</div>
