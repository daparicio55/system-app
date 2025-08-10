@props([
    'items' => null,
    'label' => 'Buscar',
    'wireModel' => 'model',
])
<div x-data="selector()" x-init="inicializar()">
    <x-label for="buscando" value="{{ $label }}" />
    <x-input x-model="buscando" @input="mostrar = true" class="mt-1 block w-full" />

    <!-- Lista de resultados -->
    <ul x-show="mostrar" class="border border-gray-300 rounded mt-2 p-2 max-h-48 overflow-y-auto">
        <template x-for="item in filteredItems()" :key="item.id">
            <li class="cursor-pointer p-1 hover:bg-gray-100"
                @click="$wire.set('{{ $wireModel }}', item.id); $wire.setProducto(item.id); seleccionarItem(item)">
                <span x-text="item.nombre"></span>
            </li>
        </template>
        <li x-show="filteredItems().length === 0" class="text-gray-500">
            No se encontraron resultados
        </li>
    </ul>

</div>

<script>
    function selector() {
        return {
            buscando: '',
            mostrar: false,
            items: @json($items), // tu array de productos desde PHP
            filteredItems() {
                const texto = this.buscando.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                return this.items.filter(p =>
                    p.nombre.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(texto)
                );
            },
            seleccionarItem(item) {
                this.buscando = item.nombre;
                this.mostrar = false;
            },
            inicializar() {
                // Opcional: carga inicial
            }
        };
    }
</script>
