<x-dialog-modal wire:model="modal_edit" maxWidth="70">
    <x-slot name="title">
        {{ __('Editar Catálogo') }}
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-3">
                {{-- catalogo padre --}}
                <x-label for="catalogo_id" value="{{ __('Catálogo Padre') }}" />
                <x-select wire:model="array_catalogo.catalogo_id">
                    <option wire:key="edit-catalogo" value="">-- Seleccione Catálogo Padre --</option>
                    @foreach ($catalogos as $catalogo)
                        <option wire:key="edit-catalogo-{{ $catalogo['id'] }}" value="{{ $catalogo['id'] }}">
                            X {{ $catalogo['medida']['nombre'] ?? 'N/A' }}
                            -
                            {{ $catalogo['codigo'] }}
                            {{ $catalogo['nombre'] }}
                            {{ $catalogo['descripcion'] }}
                            -
                            {{ $catalogo['marca']['nombre'] ?? 'N/A' }}
                            -
                            {{ $catalogo['categoria']['nombre'] ?? 'N/A' }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="array_catalogo.catalogo_id" class="mt-2" />
            </div>

            <div>
                <x-label for="array_catalogo.categoria_id" value="{{ __('Categoría') }}" />
                <x-select wire:model="array_catalogo.categoria_id">
                    <option wire:key="edit-categoria">-- Seleccione Categoría --</option>
                    @foreach ($categorias as $categoria)
                        <option wire:key="edit-categoria-{{ $categoria['id'] }}" value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                    @endforeach
                </x-select>
                <x-button class="mt-2" wire:click="modalCreateCategoria">
                    {{ __('Crear Nueva Categoría') }}
                </x-button>
                <x-input-error for="array_catalogo.categoria_id" class="mt-2" />
            </div>

            <div>
                <x-label for="marca_id" value="{{ __('Marca') }}" />
                <x-select wire:model.defer="array_catalogo.marca_id">
                    <option wire:key="edit-marca" value="">-- Seleccione Marca --</option>
                    @foreach ($marcas as $marca)
                        <option wire:key="edit-marca-{{ $marca['id'] }}" value="{{ $marca['id'] }}">{{ $marca['nombre'] }}</option>
                    @endforeach
                </x-select>
                <x-button class="mt-2" wire:click="modalCreateMarca">
                    {{ __('Crear Nueva Marca') }}
                </x-button>
                <x-input-error for="array_catalogo.marca_id" class="mt-2" />
            </div>

            <div>
                <x-label for="medida_id" value="{{ __('Medida') }}" />
                <x-select wire:model="array_catalogo.medida_id">
                    <option value="" wire:key="edit-medida" >-- Seleccione Medida --</option>
                    @foreach ($medidas as $medida)
                        <option wire:key="edit-medida-{{ $medida['id'] }}" value="{{ $medida['id'] }}">{{ $medida['nombre'] }}</option>
                    @endforeach
                </x-select>
                <x-button class="mt-2" wire:click="modalCreateMedida">
                    {{ __('Crear Nueva Medida') }}
                </x-button>
                <x-input-error for="array_catalogo.medida_id" class="mt-2" />
            </div>

            <div>
                <x-label for="codigo" value="{{ __('Código') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_catalogo.codigo" />
                <x-input-error for="array_catalogo.codigo" class="mt-2" />
            </div>

            <div>
                <x-label for="nombre" value="{{ __('Nombre') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_catalogo.nombre" />
                <x-input-error for="array_catalogo.nombre" class="mt-2" />
            </div>

            <div>
                <x-label for="contiene" value="{{ __('Contenido') }}" />
                <x-input class="mt-1 block w-full" type="number" step="0.01"
                    wire:model.defer="array_catalogo.contiene" />
                <x-input-error for="array_catalogo.contiene" class="mt-2" />
            </div>

            <div>
                <x-label for="precio" value="{{ __('Precio') }}" />
                <x-input class="mt-1 block w-full" type="number" step="0.01"
                    wire:model.defer="array_catalogo.precio" />
                <x-input-error for="array_catalogo.precio" class="mt-2" />
            </div>

            <div class="col-span-2">
                <x-label for="descripcion" value="{{ __('Descripción') }}" />
                <x-input class="mt-1 block w-full" wire:model.defer="array_catalogo.descripcion"></x-input>
                <x-input-error for="array_catalogo.descripcion" class="mt-2" />
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-modal-buttons model="modal_edit" store="update({{ $catalogo_id }})" />
    </x-slot>
</x-dialog-modal>
