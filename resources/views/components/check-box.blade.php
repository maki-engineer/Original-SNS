@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500',
    'type' => 'checkbox',
]) !!}>
