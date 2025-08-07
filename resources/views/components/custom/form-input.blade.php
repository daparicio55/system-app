@props([
    'label' => 'Etiqueta',
    'model' => null,
])
{{-- juntamos las clases --}}
<div class="{{ $attributes->get('class') }}">
    <x-label for="{{ $model }}" value="{{ __($label) }}" />
    <x-input class="mt-1 block w-full" wire:model.defer="{{ $model }}" />
    <x-input-error for="{{ $model }}" class="mt-2" />
</div>
