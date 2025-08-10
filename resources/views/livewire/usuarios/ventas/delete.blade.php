  <x-confirmation-modal wire:model.live="modal_delete">
      <x-slot name="title">
          {{ __('Borrar Venta') }}
      </x-slot>
      <x-slot name="content">
          ¿Estás seguro de que deseas eliminar la venta <b>{{ $array_venta['tipo_comprobante'] }} {{ Str::padLeft($array_venta['numero'], 4, '0') }}</b>? Esta acción no se
          puede deshacer.
      </x-slot>
      <x-slot name="footer">
          <x-secondary-button wire:click="$toggle('modal_delete')">
              {{ __('Cancel') }}
          </x-secondary-button>
          <x-danger-button class="ms-3" wire:click="delete({{ $array_venta['id'] }})">
              {{ __('Delete') }}
          </x-danger-button>
      </x-slot>
  </x-confirmation-modal>
