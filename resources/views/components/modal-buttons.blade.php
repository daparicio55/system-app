@props([
    'model' => 'modal_create',
    'store' => 'store',
])
<div>
    <x-secondary-button wire:click="$toggle('{{ $model }}')" wire:loading.attr="disabled">
        {{ __('Cancelar') }}
    </x-secondary-button>
    <x-button class="ms-3" wire:click="{{ $store }}" wire:loading.attr="disabled">
        {{ __('Guardar') }}
    </x-button>
</div>
