@props(['value'])

<label {{ $attributes->merge(['class' => 'font-bold text-gray-600 text-xl']) }}>
    {{ $value ?? $slot }}
</label>
