@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'rounded-md shadow-sm border-gray-200 bg-gray-100 focus:border-green-300 focus:ring-5 focus:ring-green-200 focus:ring-opacity-50 focus:bg-white focus:border-green-200',
]) !!}>
