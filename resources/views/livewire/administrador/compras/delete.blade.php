  <x-confirmation-modal wire:model.live="modal_delete">
      <x-slot name="title">
          {{ __('Delete Buy') }}
      </x-slot>
      <x-slot name="content">
          ¿Estás seguro de que deseas eliminar la compra <b>{{ $array_compra['numero_factura'] }}</b>? Esta acción no se
          puede deshacer.
      </x-slot>
      <x-slot name="footer">
          <x-secondary-button wire:click="$toggle('modal_delete')">
              {{ __('Cancel') }}
          </x-secondary-button>
          <x-danger-button class="ms-3" wire:click="delete({{ $array_compra['id'] }})">
              {{ __('Delete') }}
          </x-danger-button>
      </x-slot>
  </x-confirmation-modal>
