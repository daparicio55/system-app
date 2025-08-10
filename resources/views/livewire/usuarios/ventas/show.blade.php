<x-dialog-modal wire:model.live="modal_show" maxWidth="70">
    <x-slot name="title">
        <div class="bg-gray-800 text-white p-2 rounded-tl-lg rounded-tr-lg">
            Detalle de la Venta
        </div>
    </x-slot>

    <x-slot name="content">
        @if (isset($array_venta->id))
            <div class="space-y-4">
                @if ($array_venta)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 px-2 gap-y-2 text-sm text-gray-800">
                        <div>
                            <strong>Tipo Comprobante:</strong>
                            <div>{{ $array_venta->tipo_comprobante }}</div>
                        </div>
                        <div>
                            <strong>Número:</strong>
                            <div>{{ Str::padLeft($array_venta->numero, 4, '0') }}</div>
                        </div>
                        <div>
                            <strong>Número de Documento:</strong>
                            <div>{{ $array_venta->cliente->dni_ruc }}</div>
                        </div>
                        <div>
                            <strong>Cliente:</strong>
                            <div>{{ $array_venta->cliente->nombres }} {{ $array_venta->cliente->apellido_paterno }} {{ $array_venta->cliente->apellido_materno }}</div>
                        </div>
                        <div>
                            <strong>Fecha:</strong>
                            <div>{{ $array_venta->fecha }}</div>
                        </div>
                        <div>
                            <strong>Registrado por:</strong>
                            <div>{{ $array_venta->user->name ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-base font-semibold text-gray-900 mb-2">Detalle de Ítems Vendidos</h3>
                        <div class="overflow-auto rounded-tl-lg rounded-tr-lg">
                            <table class="min-w-full divide-y divide-gray-200 border text-sm">
                                <thead class="border-b font-medium dark:border-neutral-500 bg-gray-800 text-white ">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium">Cant.</th>
                                        <th class="px-4 py-2 text-left font-medium">Descripción</th>
                                        <th class="px-4 py-2 text-left font-medium">Pre. Uni.</th>
                                        <th class="px-4 py-2 text-left font-medium">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($array_venta->catalogos as $catalogo)
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
                                            {{ number_format($array_venta->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-extrabold text-right pr-2">IGV</td>
                                        <td class="font-extrabold text-right">S/ {{ number_format($array_venta->Igvtotal, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="font-extrabold text-right pr-2">TOTAL</td>
                                        <td class="font-extrabold text-right">S/
                                            {{ number_format($array_venta->total + $array_venta->Igvtotal, 2) }}</td>
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
