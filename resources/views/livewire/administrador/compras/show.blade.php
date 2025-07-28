<x-dialog-modal wire:model.live="modal_show" maxWidth="70">
    <x-slot name="title">
        Detalle de la Compra
    </x-slot>

    <x-slot name="content">
        @if (isset($array_compra->id))
            <div class="space-y-4">
                @if ($array_compra)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm text-gray-800">
                        <div>
                            <strong>Fecha:</strong>
                            <div>{{ $array_compra->fecha }}</div>
                        </div>
                        <div>
                            <strong>Número de Factura:</strong>
                            <div>{{ $array_compra->numero_factura }}</div>
                        </div>
                        <div>
                            <strong>Pagado:</strong>
                            <div>{{ $array_compra->pagado ? 'Sí' : 'No' }}</div>
                        </div>
                        <div>
                            <strong>IGV:</strong>
                            <div>{{ $array_compra->igv ? 'Sí' : 'No' }}</div>
                        </div>
                        <div>
                            <strong>Proveedor:</strong>
                            <div>{{ $array_compra->proveedore->razon_social ?? '—' }}</div>
                        </div>
                        <div>
                            <strong>Registrado por:</strong>
                            <div>{{ $array_compra->user->name ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-base font-semibold text-gray-900 mb-2">Detalle de Ítems Comprados</h3>
                        <div class="overflow-auto">
                            <table class="min-w-full divide-y divide-gray-200 border text-sm">
                                <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium">Cant.</th>
                                        <th class="px-4 py-2 text-left font-medium">Descripción</th>
                                        <th class="px-4 py-2 text-left font-medium">Pre. Uni.</th>
                                        <th class="px-4 py-2 text-left font-medium">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($array_compra->catalogos as $catalogo)
                                        <tr>
                                            <td class="px-4 py-2">{{ number_format($catalogo->pivot->cantidad, 2) }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $catalogo->codigo . ' - ' . $catalogo->nombre . '- ' . $catalogo->descripcion . ' - ' . $catalogo->marca->nombre . ' - ' . $catalogo->categoria->nombre . ' - X' . $catalogo->medida->nombre }}
                                            </td>
                                            <td class="px-4 py-2">S/
                                                {{ number_format($catalogo->pivot->precio_unitario, 2) }}
                                            </td>
                                            <td class="px-4 py-2">S/
                                                {{ number_format($catalogo->pivot->cantidad * $catalogo->pivot->precio_unitario, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="font-extrabold text-right pr-2">SUBTOTAL</td>
                                        <td class="font-extrabold text-right">S/
                                            {{ number_format($array_compra->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-extrabold text-right pr-2">IGV</td>
                                        <td class="font-extrabold text-right">S/ {{ number_format($array_compra->Igvtotal, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-extrabold text-right pr-2">TOTAL</td>
                                        <td class="font-extrabold text-right">S/
                                            {{ number_format($array_compra->subtotal + $array_compra->Igvtotal, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="$toggle('modal_show')" class="bg-red-600 text-white">
            Cerrar
        </x-button>
    </x-slot>
</x-dialog-modal>
