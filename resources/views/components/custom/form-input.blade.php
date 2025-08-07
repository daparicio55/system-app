@props([
    'label' => 'Etiqueta',
    'model' => null,
    'type' => 'text'
])
{{-- juntamos las clases --}}
<div class="{{ $attributes->get('class') }}">
    <x-label for="{{ $model }}" value="{{ __($label) }}" />
    <x-input class="mt-1 block w-full" wire:model.defer="{{ $model }}" type="{{ $type }}" />
    <x-input-error for="{{ $model }}" class="mt-2" />
</div>
